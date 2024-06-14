@extends('layouts.guest')

@section('content')
@if (Session::has('error'))
<script>
Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: '{{ Session::get("error")}}',
});
</script>
@endif
<div class="form-container flex flex-wrap content-center justify-center w-screen h-screen"
  style="background-image: url('images/login-bg.jpg')">
  <form class="bg-white rounded-md shadow-lg p-8 flex flex-col w-fit h-fit" method="post" action="/login">
    @csrf
    <h1 class="font-bold text-center text-2xl mb-4 text-blue-400">Login</h1>
    <div class="input-container relative">
      <svg class="w-4 h-4 top-2 left-1 absolute fill-blue-400 text-gray-800" aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
        <path
          d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
      </svg>
      <input name="username" class="w-72 border border-gray-200 px-6 py-1 rounded-md mb-4 outline-none" type="text"
        placeholder="username">
    </div>
    <div class="input-container relative">
      <svg class="w-4 h-4 top-2 left-1 absolute fill-blue-400" aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
        <path
          d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8h-5V4.5a2.5 2.5 0 1 1 5 0V7Z" />
      </svg>
      <input name="password" class="w-72 border border-gray-200 px-6 py-1 rounded-md outline-none" type="password"
        placeholder="password">
    </div>

    <button class="w-72 py-1 button-login mt-8 text-white bg-blue-500 rounded-md">Login</button>
  </form>
</div>
@endsection