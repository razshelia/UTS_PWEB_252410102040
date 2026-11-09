<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected function akunDefault(): array
    {
        return [
            [
                'username' => 'asa',
                'password' => Hash::make('asa123'),
                'usia' => 16,
                'peran' => 'Siswa Sekolah', // Disesuaikan dengan PageController
            ],
            [
                'username' => 'berry',
                'password' => Hash::make('berry123'),
                'usia' => 21,
                'peran' => 'Mahasiswa Aktif', // Disesuaikan dengan PageController
            ],
            [
                'username' => 'kakak',
                'password' => Hash::make('kakak123'),
                'usia' => 27,
                'peran' => 'Pekerja Mapan', // Disesuaikan dengan PageController
            ],
        ];
    }

    protected function semuaAkun(Request $request): array
    {
        return array_merge(
            $this->akunDefault(),
            $request->session()->get('akun', [])
        );
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|min:3|max:20|alpha_dash',
            'usia' => 'required|integer|min:10|max:80',
            'peran' => 'required|in:' . implode(',', PageController::PERAN),
            'password' => 'required|string|min:6|max:255|confirmed',
        ]);

        $username = strtolower($data['username']);

        foreach ($this->semuaAkun($request) as $akun) {
            if (strtolower($akun['username']) === $username) {
                return back()
                    ->withErrors(['username' => 'Username sudah digunakan.'])
                    ->withInput();
            }
        }

        $akunBaru = $request->session()->get('akun', []);
        $akunBaru[] = [
            'username' => $username,
            'password' => Hash::make($data['password']),
            'usia' => (int) $data['usia'],
            'peran' => $data['peran'],
        ];

        $request->session()->put('akun', $akunBaru);

        return redirect('/login')
            ->with('success', 'Akun berhasil dibuat. Silakan masuk.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string|max:20',
            'password' => 'required|string|max:255',
        ]);

        $username = strtolower($credentials['username']);

        foreach ($this->semuaAkun($request) as $akun) {
            if (
                strtolower($akun['username']) === $username &&
                Hash::check($credentials['password'], $akun['password'])
            ) {
                $request->session()->regenerate();

                $request->session()->put('user', [
                    'username' => $akun['username'],
                    'usia' => $akun['usia'],
                    'peran' => $akun['peran'],
                ]);

                return redirect()->route('home', [
                    'username' => $akun['username'],
                    'peran' => $akun['peran'],
                ]);
            }
        }

        return back()
            ->withErrors(['username' => 'Username atau password salah.'])
            ->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah keluar.');
    }
}