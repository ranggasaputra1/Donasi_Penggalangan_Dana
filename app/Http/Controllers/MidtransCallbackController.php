<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Midtrans\CallbackService;
use Illuminate\Support\Facades\Redirect;

class MidtransCallbackController extends Controller
{
    public function receive()
    {
        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $transaksi = $callback->getTransaksi();
            $dana = Campaign::where('id', $transaksi->campaign_id)->value('dana_terkumpul');
            if ($callback->isSuccess()) {
                Transaksi::where('id', $transaksi->id)->update([
                    'status_transaksi' => 1,
                ]);
                Campaign::where('id', $transaksi->campaign_id)->update([
                    'dana_terkumpul' => $dana + ($transaksi->nominal_transaksi),
                ]);
            }

            if ($callback->isExpire()) {
                Transaksi::where('id', $transaksi->id)->update([
                    'status_transaksi' => 2,
                ]);
            }

            if ($callback->isCancelled()) {
                Transaksi::where('id', $transaksi->id)->update([
                    'status_transaksi' => 3,
                ]);
            }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notifikasi berhasil diproses',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi',
                ], 403);
        }
    }
}
