<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportSpgdtController extends Controller
{

    public function getData(Request $request)
    {
        $data = collect([
            [
                "id" => 1,
                "code" => "SPGDT-20260401-001",
                "name" => "Budi",
                "phone" => "08123456789",
                "level" => "high",
                "location" => "Jl. Sudirman",
                "status" => "pending",
                "reported_at" => "2026-04-01 10:00:00"
            ],
            [
                "id" => 2,
                "code" => "SPGDT-20260402-002",
                "name" => "Siti",
                "phone" => "08129876543",
                "level" => "low",
                "location" => "Jl. Thamrin",
                "status" => "on_progress",
                "reported_at" => "2026-04-02 12:30:00"
            ],
            [
                "id" => 3,
                "code" => "SPGDT-20260403-003",
                "name" => "Andi",
                "phone" => "08127778888",
                "level" => "medium",
                "location" => "Jl. Gatot Subroto",
                "status" => "done",
                "reported_at" => "2026-04-03 09:15:00"
            ],
            [
                "id" => 4,
                "code" => "SPGDT-20260404-004",
                "name" => "Dewi",
                "phone" => "08131112223",
                "level" => "high",
                "location" => "Jl. Rasuna Said",
                "status" => "pending",
                "reported_at" => "2026-04-04 14:20:00"
            ],
            [
                "id" => 5,
                "code" => "SPGDT-20260405-005",
                "name" => "Eko",
                "phone" => "08134445556",
                "level" => "low",
                "location" => "Jl. S. Parman",
                "status" => "on_progress",
                "reported_at" => "2026-04-05 08:45:00"
            ],
            [
                "id" => 6,
                "code" => "SPGDT-20260406-006",
                "name" => "Fani",
                "phone" => "08137778889",
                "level" => "medium",
                "location" => "Jl. Pemuda",
                "status" => "done",
                "reported_at" => "2026-04-06 11:10:00"
            ],
            [
                "id" => 7,
                "code" => "SPGDT-20260407-007",
                "name" => "Gani",
                "phone" => "08129990001",
                "level" => "high",
                "location" => "Jl. Kebon Jeruk",
                "status" => "pending",
                "reported_at" => "2026-04-07 16:05:00"
            ],
            [
                "id" => 8,
                "code" => "SPGDT-20260408-008",
                "name" => "Hana",
                "phone" => "08126665554",
                "level" => "medium",
                "location" => "Jl. Asia Afrika",
                "status" => "on_progress",
                "reported_at" => "2026-04-08 13:50:00"
            ],
            [
                "id" => 9,
                "code" => "SPGDT-20260409-009",
                "name" => "Iwan",
                "phone" => "08123334442",
                "level" => "low",
                "location" => "Jl. Ahmad Yani",
                "status" => "done",
                "reported_at" => "2026-04-09 10:30:00"
            ],
            [
                "id" => 10,
                "code" => "SPGDT-20260410-010",
                "name" => "Joko",
                "phone" => "08138887771",
                "level" => "high",
                "location" => "Jl. Pajajaran",
                "status" => "pending",
                "reported_at" => "2026-04-10 17:00:00"
            ],
        ]);

        if ($request->filled('code')) {
            $data = $data->where('code', $request->code);
        }

        if ($request->filled('name')) {
            $data = $data->filter(function ($item) use ($request) {
                return str_contains(strtolower($item['name']), strtolower($request->name));
            });
        }

        if ($request->filled('level')) {
            $data = $data->where('level', $request->level);
        }

        if ($request->filled('status')) {
            $data = $data->where('status', $request->status);
        }

        if ($request->filled('location')) {
            $data = $data->filter(function ($item) use ($request) {
                return str_contains(strtolower($item['location']), strtolower($request->location));
            });
        }

        if ($request->filled('start_date') || $request->filled('end_date')) {
            $data = $data->filter(function ($item) use ($request) {

                $date = substr($item['reported_at'], 0, 10);

                if ($request->filled('start_date') && $date < $request->start_date) {
                    return false;
                }

                if ($request->filled('end_date') && $date > $request->end_date) {
                    return false;
                }

                return true;
            });
        }

        return response()->json([
            "status" => "success",
            "total" => $data->count(),
            "data" => $data->values()
        ]);
    }
}
