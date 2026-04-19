<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Support\DataTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(): View
    {
        return view('admin.members.index');
    }

    public function data(Request $request): JsonResponse
    {
        return DataTable::eloquent(
            $request,
            Member::query(),
            ['member_code', 'name', 'email', 'phone'],
            fn (Member $member) => [
                'member_code' => $member->member_code,
                'name' => $member->name,
                'email' => $member->email,
                'phone' => $member->phone ?? '-',
                'actions' => view('admin.members.partials.actions', compact('member'))->render(),
            ],
        );
    }

    public function create(): View
    {
        $member = new Member(['member_code' => $this->generateMemberCode()]);

        return view('admin.members.form', [
            'member' => $member,
            'pageTitle' => 'Tambah Anggota',
            'formAction' => route('admin.members.store'),
            'formMethod' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $member = Member::create($this->validatedData($request, null, true));

        return redirect()->route('admin.members.index')->with('success', "Anggota {$member->name} berhasil ditambahkan.");
    }

    public function edit(Member $member): View
    {
        return view('admin.members.form', [
            'member' => $member,
            'pageTitle' => 'Edit Anggota',
            'formAction' => route('admin.members.update', $member),
            'formMethod' => 'PUT',
        ]);
    }

    public function update(Request $request, Member $member): RedirectResponse
    {
        $member->update($this->validatedData($request, $member, false));

        return redirect()->route('admin.members.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Member $member): JsonResponse
    {
        if ($member->loans()->exists()) {
            return response()->json([
                'message' => 'Anggota tidak bisa dihapus karena sudah memiliki histori pengajuan.',
            ], 422);
        }

        $member->delete();

        return response()->json([
            'message' => 'Anggota berhasil dihapus.',
        ]);
    }

    private function validatedData(Request $request, ?Member $member = null, bool $requirePassword = false): array
    {
        $data = $request->validate([
            'member_code' => ['required', 'string', 'max:50', Rule::unique('members', 'member_code')->ignore($member?->id)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('members', 'email')->ignore($member?->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'password' => [$requirePassword ? 'required' : 'nullable', 'string', 'min:6'],
        ]);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        return $data;
    }

    private function generateMemberCode(): string
    {
        $number = (Member::max('id') ?? 0) + 1;

        do {
            $code = 'AGT'.str_pad((string) $number, 3, '0', STR_PAD_LEFT);
            $number++;
        } while (Member::where('member_code', $code)->exists());

        return $code;
    }
}
