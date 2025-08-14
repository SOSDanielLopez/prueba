<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::latest();

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('nombres', 'LIKE', "%{$search}%")
                  ->orWhere('apellidos', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('programa', 'LIKE', "%{$search}%");
            });
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'programa' => 'required|string',
        ]);

        // Lógica para actualizar si el email ya existe
        $lead = Lead::updateOrCreate(
            ['email' => $validatedData['email']],
            [
                'nombres' => $validatedData['nombres'],
                'apellidos' => $validatedData['apellidos'],
                'telefono' => $validatedData['telefono'],
                'programa' => $validatedData['programa'],
                'contactado' => false,
            ]
        );

        return response()->json($lead, 201);
    }

    // Marcar un lead como contactado
    public function markAsContacted(Lead $lead)
    {
        $lead->update(['contactado' => true]);
        return response()->json($lead);
    }
}