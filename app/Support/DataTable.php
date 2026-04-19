<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DataTable
{
    public static function eloquent(
        Request $request,
        Builder $query,
        array $columns,
        callable $transform,
    ): JsonResponse {
        $draw = (int) $request->integer('draw', 1);
        $start = max((int) $request->integer('start', 0), 0);
        $length = max((int) $request->integer('length', 10), 1);
        $search = trim((string) data_get($request->input('search'), 'value', ''));
        $recordsTotal = (clone $query)->count();

        if ($search !== '') {
            $query->where(function (Builder $builder) use ($columns, $search): void {
                foreach ($columns as $index => $column) {
                    $method = $index === 0 ? 'where' : 'orWhere';
                    $builder->{$method}($column, 'like', "%{$search}%");
                }
            });
        }

        $recordsFiltered = (clone $query)->count();
        $orderIndex = (int) data_get($request->input('order'), '0.column', 0);
        $orderDir = strtolower((string) data_get($request->input('order'), '0.dir', 'asc')) === 'desc' ? 'desc' : 'asc';
        $orderColumn = $columns[$orderIndex] ?? $columns[0];

        $data = $query
            ->orderBy($orderColumn, $orderDir)
            ->skip($start)
            ->take($length)
            ->get()
            ->map($transform)
            ->values();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }
}
