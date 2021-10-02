@extends('layouts.template')

@section('title')
<title>SURVEY DETAIL {{ strtoupper($data->klasi->nama) }} | DINAS PERKIM KOTA TANGERANG </title>
<style>
     .file {
          visibility: hidden;
          position: absolute;
     }
</style>
@endsection

@section('content')
<section class="section">
     <div class="section-header">
          <h1>Detail Survey</h1>
          <div class="section-header-breadcrumb">
               <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
               <div class="breadcrumb-item"><a href="{{ route('survey') }}">Survey</a></div>
               <div class="breadcrumb-item">{{ ucwords($data->klasi->nama) }}</div>
          </div>
     </div>
     <h2 class="section-title">
          <a href="{{ route('survey') }}" title="Kembali" class="btn btn-icon btn-sm btn-warning rounded-circle icon-back">
               <i class="fas fa-arrow-circle-left"></i>
          </a> 
          Klasifikasi : {{ ucwords($data->klasi->nama) }}
     </h2>
     <p class="section-lead">Nama Objek : {{ ucwords($data->nama_objek) }}</p>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         @include('pages.pembangunan.index');
                    </div>
               </div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         @include('pages.rehabilitasi.index');
                    </div>
               </div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         @include('pages.spesifikasi.index')
                    </div>
               </div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         @include('pages.kondisi.index')
                    </div>
               </div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         @include('pages.site-plan.index')
                    </div>
               </div>
          </div>
     </div>
     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         @include('pages.survey-validasi.index')
                    </div>
               </div>
          </div>
     </div>
</section>
@endsection

@section('modal')
     @include('pages.survey.detail-modal')
@endsection

@section('script')
     @include('pages.survey.detail-script')
@endsection