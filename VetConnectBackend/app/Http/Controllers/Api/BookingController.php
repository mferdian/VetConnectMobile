<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VetResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Booking;
use App\Models\Vet;

class BookingController extends Controller
{
    // [POST] Buat booking
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vet_id' => 'required|exists:vets,id',
            'vet_date_id' => 'required|exists:vet_dates,id',
            'vet_time_id' => 'required|exists:vet_times,id',
            'keluhan' => 'nullable|string',
            'total_harga' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:transfer_bank,e-wallet,cash,lainnya',
        ]);


        $exists = Booking::where([
            'vet_date_id' => $validated['vet_date_id'],
            'vet_time_id' => $validated['vet_time_id'],
        ])->where('status', '!=', 'cancelled')->exists();

        if ($exists) {
            return response()->json(['message' => 'Waktu tersebut sudah dibooking'], 400);
        }

        $booking = Booking::create([
            'order_id' => 'ORD-' . Str::uuid(),
            'user_id' => $request->user()->id,
            'vet_id' => $validated['vet_id'],
            'vet_date_id' => $validated['vet_date_id'],
            'vet_time_id' => $validated['vet_time_id'],
            'keluhan' => $validated['keluhan'] ?? null,
            'total_harga' => $validated['total_harga'],
            'status' => 'confirmed',
            'status_bayar' => 'berhasil',
            'metode_pembayaran' => $validated['metode_pembayaran'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dibuat',
            'data' => $booking
        ], 201);
    }

    // [GET] Daftar booking user
    public function index(Request $request)
    {
        $bookings = Booking::with(['vet', 'vetDate', 'vetTime'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $bookings
        ]);
    }

    // [GET] Detail booking
    public function show(Request $request, $id)
    {
        $booking = Booking::with(['vet', 'vetDate', 'vetTime'])
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $booking
        ]);
    }

    // [PATCH] Batalkan booking
    public function cancel(Request $request, $id)
    {
        $booking = Booking::where('user_id', $request->user()->id)->findOrFail($id);

        if ($booking->status !== 'confirmed') {
            return response()->json(['success' => false, 'message' => 'Booking tidak bisa dibatalkan'], 400);
        }

        $booking->update([
            'status' => 'cancelled',
            'status_bayar' => 'dibatalkan'
        ]);

        return response()->json(['success' => true, 'message' => 'Booking berhasil dibatalkan']);
    }

    // [GET] Semua dokter
    public function showVet()
    {
        $vets = Vet::all();
        return response()->json([
            'success' => true,
            'data' => VetResource::collection($vets)
        ]);
    }

    // [GET] Detail dokter
    public function detailVet($id)
    {
        $vet = Vet::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => new VetResource($vet)
        ]);
    }

    // [GET] Jadwal dokter
    public function schedule($id)
    {
        $vet = Vet::with(['vetDates.vetTimes'])->findOrFail($id);

        $jadwal = $vet->vetDates->map(function ($date) {
            return [
                'tanggal_id' => $date->id,
                'tanggal' => $date->tanggal,
                'waktu' => $date->vetTimes->map(function ($time) {
                    return [
                        'waktu_id' => $time->id,
                        'jam' => $time->jam_mulai . ' - ' . $time->jam_selesai,
                    ];
                }),
            ];
        });

        return response()->json([
            'success' => true,
            'vet_id' => $vet->id,
            'nama' => $vet->nama,
            'jadwal' => $jadwal
        ]);
    }

    public function markAsCompleted($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Completed';
        $booking->save();

        return response()->json([
            'message' => 'Booking marked as completed',
            'data' => $booking,
        ]);
    }
}
