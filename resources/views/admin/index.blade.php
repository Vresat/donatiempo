@extends('admin._layouts.master')

@section('body')
    <h3 class="text-gray-700 text-3xl font-medium">Usuarios</h3>
    <div class="flex flex-col mt-8">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                            <img class="object-cover w-8 h-8 mx-1 rounded-full" src="{{$user->avatar}}" alt="avatar">
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900">{{$user->name}}</div>
                                        <div class="text-sm leading-5 text-gray-500">{{$user->email}}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full  {{$user->active ? 'bg-green-100 text-green-800': 'bg-red-100 text-red-800'}}">{{$user->active ? 'Activo':'Desactivado'}}</span>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$user->isadmin ? 'Administrador' : 'Cliente'}}</td>

                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                <a href="{{route('adminEditUser',$user)}}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                        {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection