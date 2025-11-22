<?php

namespace App\Livewire\Features\Admin\ListQualifier;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class QualifierCreate extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi',
        'name.min' => 'Nama minimal 3 karakter',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validated = $this->validate();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'qualifier',
        ]);

        session()->flash('message', 'Qualifier berhasil ditambahkan!');

        return $this->redirect('/qualifier', navigate: true);
    }

    public function render()
    {
        return view('livewire.features.admin.list-qualifier.qualifier-create')
            ->layout('components.layouts.app');
    }
}
