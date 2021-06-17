<!DOCTYPE html>
<html lang="id">
    <head>
    	@include('app.partials.head')
        <style>
            textarea::placeholder {
                color: rgba(16, 16, 16, 0.3)!important;
            }
        </style>
    </head>
    <body class="header-fixed">
    	@include('app.partials.header')
        <div class="page-body">
        	@include('app.partials.sidebar')
            <div class="page-content-wrapper">
            	<h5 class="font-weight-bold pb-2 text-center" id="accountCompany"></h5>
                <div class="page-content-wrapper-inner">
                    <div class="content-viewport">
						<div class="pb-2 d-flex justify-content-md-start justify-content-center">
							<ul class="list-inline">
								<li class="list-inline-item"><a href="./dashboard" class="text-danger">Dashboard</a></li>
								<li class="list-inline-item">></li>
								<li class="list-inline-item text-muted">Entri Jurnal</li>
							</ul>
						</div>
						<div class="alert alert-success fade show none" role="alert" id="alert">
							Data berhasil disimpan.
						</div>
                        <div class="grid border">
                            <div class="grid-body">
                            	<form id="form">
	                                <div class="form-row">
	                                    <div class="col-sm-6 form-group">
	                                        <label for="jurnalDate">Tanggal Jurnal</label>
	                                        <input type="date" class="form-control bg-white" id="jurnalDate">
                                            <div class="invalid-feedback" id="jurnalDate-feedback"></div>
	                                    </div>
	                                </div>
	                                <div class="form-row">
	                                    <div class="col-sm-6 form-group">
	                                        <label for="jurnalType">Jenis Transaksi</label>
	                                        <select class="custom-select bg-white" id="jurnalType">
	                                            <option disabled selected>Pilih</option>
	                                        </select>
                                            <div class="invalid-feedback" id="jurnalType-feedback"></div>
	                                    </div>
	                                </div>
	                                <div class="form-row">
	                                    <div class="col-sm-6 form-group">
	                                        <label for="kredit" id="kredit-label">Diterima dari</label>
	                                        <select class="custom-select bg-white" id="kredit">
	                                            <option disabled selected>Pilih</option>
	                                        </select>
                                            <div class="invalid-feedback" id="kredit-feedback"></div>
	                                    </div>
	                                    <div class="col-sm-6 form-group">
	                                        <label for="debit" id="dedit-label">Simpan ke</label>
	                                        <select class="custom-select bg-white" id="debit">
	                                            <option disabled selected>Pilih</option>
	                                        </select>
                                            <div class="invalid-feedback" id="debit-feedback"></div>
	                                    </div>
	                                </div>
	                                <div class="form-row">
	                                    <div class="col-sm-6 form-group">
	                                        <label for="jurnalNominal">Nominal</label>
	                                        <input type="tel" class="form-control bg-white" id="jurnalNominal" placeholder="Rp" autocomplete="off">
                                            <div class="invalid-feedback" id="jurnalNominal-feedback"></div>
	                                    </div>
	                                </div>
	                                <div class="form-row">
	                                    <div class="col-sm-6 form-group">
	                                        <label for="jurnalDescription">Keterangan (Optional)</label>
	                                        <textarea rows="3" class="form-control bg-white" id="jurnalDescription" placeholder="Optional"></textarea>
                                            <div class="invalid-feedback" id="jurnalDescription-feedback"></div>
	                                    </div>
	                                </div>
	                                <div class="d-flex">
	                                    <button class="btn btn-sm btn-danger mt-4 ml-auto border-0 font-weight-bold" id="submit">
						        			<i class="mdi mdi-loading mdi-spin pr-2 none" id="loading"></i> Simpan
						        		</button>
	                                </div>
	                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FOOTER -->
            </div>
        </div>
        @include('app.partials.footer')
        <script src="{{asset('vendor/jquery/validate.js')}}"></script>
        <script src="{{asset('vendor/jquery/number.js')}}"></script>
        <script src="{{asset('api/entri-jurnal.js')}}"></script>
        <script type="text/javascript">
            $('#jurnalNominal').keyup(function(){
                $('#jurnalNominal').val(convertToRupiah($(this).val()))
            })
        </script>
    </body>
</html>