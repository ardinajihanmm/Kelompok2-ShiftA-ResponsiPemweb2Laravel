<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        $report = $this->route('report');

        if (!$user || !$report) {
            return false;
        }

        if ($user->role === 'admin') {
            return true;
        }

        // Mahasiswa hanya boleh mengubah laporan miliknya,
        // dan tidak boleh mengubah status maupun prioritas (ditentukan admin).
        return $report->user_id === $user->id && !$this->hasAny(['status', 'priority']);
    }

    public function rules(): array
    {
        return [
            'facility_id' => ['sometimes', 'exists:facilities,id'],
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'priority' => ['sometimes', 'in:low,medium,high'],
            'status' => ['sometimes', 'in:menunggu,diproses,selesai,ditolak'],
        ];
    }
}
