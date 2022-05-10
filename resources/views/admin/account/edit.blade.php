@extends('admin.layout.master')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="card-title-member">Edit Akun</h1>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>Email</label>
                                                <input class="form-control" type="email" name="email" value="{{ $user->email }}" />
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Phone</label>
                                                <input class="form-control" type="phone" name="phone" value="{{ $user->phone }}" />
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>User Verifikasi</label>
                                                <select name="is_verified" class="custom-select" required>
                                                    <option value="0" >Pilih</option>
                                                    <option value="0" <?= $user->is_verified == 0 ? 'selected' : '' ?>>Belum Verifikasi</option>
                                                    <option value="1" <?= $user->is_verified == 1 ? 'selected' : '' ?>>Sudah Verifikasi</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Trader Terverikasi</label>
                                                <select name="trader_is_verified" class="custom-select" required>
                                                    <option value="0" >Pilih</option>
                                                    <option value="0" <?= $user->trader_is_verified == 0 ? 'selected' : '' ?>>Belum Verifikasi</option>
                                                    <option value="1" <?= $user->trader_is_verified == 1 ? 'selected' : '' ?>>Sudah Verifikasi</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Status OTP</label>
                                                <select name="is_otp" class="custom-select" required>
                                                    <option value="0" >Pilih</option>
                                                    <option value="0" <?= $user->is_otp == 0 ? 'selected' : '' ?>>Belum OTP</option>
                                                    <option value="1" <?= $user->is_otp == 1 ? 'selected' : '' ?>>Sudah OTP</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-6 form-group">
                                                <label>Status Login</label>
                                                <select name="is_logged_in" class="custom-select" required>
                                                    <option value="0" >Pilih</option>
                                                    <option value="0" <?= $user->is_logged_in == 0 ? 'selected' : '' ?>>Tidak Login</option>
                                                    <option value="1" <?= $user->is_logged_in == 1 ? 'selected' : '' ?>>Login</option>
                                                </select>
                                            </div>
                            
                                            <div class="col-md-6 form-group">
                                                <label>Request Password</label>
                                                <select name="attempt" class="custom-select" required>
                                                    <option value="0" <?= $user->attempt == 0 ? 'selected' : '' ?>>0</option>
                                                    <option value="1" <?= $user->attempt == 1 ? 'selected' : '' ?>>1</option>
                                                    <option value="2" <?= $user->attempt == 2 ? 'selected' : '' ?>>2</option>
                                                    <option value="3" <?= $user->attempt >= 3 ? 'selected' : '' ?>>Blocked</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                                <a class="btn btn-danger" href="{{ url()->previous() }}">Kembali</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
    integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    label {
        font-weight: bold;
    }
</style>
@endsection