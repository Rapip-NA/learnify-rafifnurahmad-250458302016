<?php

namespace App\Livewire\Features\Admin\ListQualifier;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class QualifierEdit extends Component
{
    public User $qualifier;
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public function mount($id)
    {
        $this->qualifier = User::where('role', 'qualifier')->findOrFail($id);
        $this->name = $this->qualifier->name;
        $this->email = $this->qualifier->email;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->qualifier->id)
            ],
            'password' => 'nullable|min:8|confirmed',
        ];
    }

    protected $messages = [
        'name.required' => 'Nama wajib diisi',
        'name.min' => 'Nama minimal 3 karakter',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'password.min' => 'Password minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $validated = $this->validate();

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        // Update password only if filled
        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $this->qualifier->update($data);

        session()->flash('message', 'Data qualifier berhasil diperbarui!');

        return $this->redirect('/qualifier', navigate: true);
    }

    public function render()
    {
        return view('livewire.features.admin.list-qualifier.qualifier-edit')
            ->layout('components.layouts.app');
    }
}
