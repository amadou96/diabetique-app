@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Gestion des utilisateurs</h2>

    <a href="{{ route('users.create') }}" class="btn btn-primary">
        + Nouvel utilisateur
    </a>

</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card shadow-sm">

    <div class="card-body p-0">

        <table class="table table-hover mb-0">

            <thead class="table-primary">
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->isAdmin())
                            <span class="badge bg-danger">Admin</span>
                        @else
                            <span class="badge bg-secondary">Infirmier</span>
                        @endif
                    </td>
                    <td class="text-end">
                        @if($user->id !== auth()->id())
                            <form action="{{ route('users.destroy', $user) }}"
                                  method="POST"
                                  onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                            </form>
                        @else
                            <span class="text-muted small">Vous</span>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
