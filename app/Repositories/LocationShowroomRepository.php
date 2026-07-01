<?php

namespace App\Repositories;

use App\Models\LocationShowroomsModel;

class LocationShowroomRepository
{
    public function GetListShowroom($Request)
    {
        $query = LocationShowroomsModel::query();

        if ($Request->filled('search')) {
            $query->where('name', 'like', '%' . trim($Request->search) . '%');
        }

        if ($Request->filled('status')) {
            $query->where('status', $Request->status);
        }

        $perPage = $Request->get('per_page', 10);

        return $query->orderByDesc('id')->paginate($perPage);
    }

    public function GetDetailShowroom($id)
    {
        return LocationShowroomsModel::find($id);
    }

    public function insertShowroom($Request)
    {
        return LocationShowroomsModel::create([
            'City' => $Request->City,
            'name' => $Request->name,
            'table' => $Request->table,
            'Opening hours' => $Request->input('Opening_hours'),
            'phone' => $Request->phone,
            'ShowroomArea' => $Request->ShowroomArea,
            'location' => $Request->location,
            'has_test_drive' => $Request->has_test_drive ? 1 : 0,
            'has_service' => $Request->has_service ? 1 : 0,
            'has_parking' => $Request->has_parking ? 1 : 0,
            'has_accessories' => $Request->has_accessories ? 1 : 0,
            'has_insurance' => $Request->has_insurance ? 1 : 0,
            'has_body_paint' => $Request->has_body_paint ? 1 : 0,
            'status' => $Request->status ?? 'active',
            'locationOnGoogle' => $Request->locationOnGoogle,
        ]);
    }

    public function UpdateShowroom($Request, $id)
    {
        $showroom = LocationShowroomsModel::find($id);

        if (!$showroom) {
            return null;
        }

        $showroom->update([
            'City' => $Request->City ?? $showroom->City,
            'name' => $Request->name ?? $showroom->name,
            'table' => $Request->table ?? $showroom->table,
            'Opening hours' => $Request->input('Opening_hours') ?? $showroom->getAttribute('Opening hours'),
            'phone' => $Request->phone ?? $showroom->phone,
            'ShowroomArea' => $Request->ShowroomArea ?? $showroom->ShowroomArea,
            'location' => $Request->location ?? $showroom->location,
            'has_test_drive' => $Request->has('has_test_drive') ? ($Request->has_test_drive ? 1 : 0) : $showroom->has_test_drive,
            'has_service' => $Request->has('has_service') ? ($Request->has_service ? 1 : 0) : $showroom->has_service,
            'has_parking' => $Request->has('has_parking') ? ($Request->has_parking ? 1 : 0) : $showroom->has_parking,
            'has_accessories' => $Request->has('has_accessories') ? ($Request->has_accessories ? 1 : 0) : $showroom->has_accessories,
            'has_insurance' => $Request->has('has_insurance') ? ($Request->has_insurance ? 1 : 0) : $showroom->has_insurance,
            'has_body_paint' => $Request->has('has_body_paint') ? ($Request->has_body_paint ? 1 : 0) : $showroom->has_body_paint,
            'status' => $Request->status ?? $showroom->status,
            'locationOnGoogle' => $Request->locationOnGoogle ?? $showroom->locationOnGoogle,
        ]);

        return $showroom->fresh();
    }

    public function DeleteShowroom($id)
    {
        $showroom = LocationShowroomsModel::find($id);

        if (!$showroom) {
            return false;
        }

        return $showroom->delete();
    }
}
