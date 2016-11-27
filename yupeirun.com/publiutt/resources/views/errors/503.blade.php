@extends('layouts.app')

@section('title', 'Serveur en surcharge')
@section('body-class', 'auth error-page')

@section('content')
<section class="background full flex-center">
  <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
          <div class="bloc-form">
            <h1>503 - Serveur en surcharge</h1>
          </div>
        </div>
      </div>
  </div>
</section>
@endsection
