@extends('company.main')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="bradcumbContent">
            <h2>Karir</h2>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### About Us Area Start ##### -->
    <section class="about-us-area mt-25 section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 wow fadeInUp" data-wow-delay="400ms">
                    <p class="text-center">
                        Di CV. DEA GROUP, kami percaya bahwa karyawan adalah aset terbesar dalam mencapai kesuksesan
                        bersama. Kami berkomitmen untuk menciptakan lingkungan kerja yang inovatif, kolaboratif, dan
                        inspiratif, di mana setiap individu dapat berkembang dan memberikan kontribusi terbaik mereka.
                    </p>
                    <div class="section-heading text-center mt-50 mx-auto wow fadeInUp" data-wow-delay="300ms">
                        <span></span>
                        <h3>Mengapa Bergabung dengan Kami?</h3>
                    </div>
                    <div class="row text-center">
                        <div class="col-12 col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Budaya Kerja Positif</h6>
                                    <p class="card-text">
                                        Lingkungan kerja yang menghargai inovasi, kerja sama, dan keberagaman.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Peluang Pengembangan Karir</h6>
                                    <p class="card-text">
                                        Peluang berkembang melalui pelatihan dan mentoring untuk kesuksesan Anda.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Kompensasi dan Benefit Kompetitif</h6>
                                    <p class="card-text">
                                        Gaji, benefit, dan penghargaan terbaik untuk kontribusi Anda.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-heading text-center mt-50 mx-auto wow fadeInUp" data-wow-delay="300ms">
                        <span>We Are Hiring !!!</span>
                        <h3>Rekrutmen Terbuka</h3>
                    </div>
                    {{-- <h3 class="text-center mt-5 mb-5">Rekrutmen Terbuka</h3> --}}
                    @foreach ($jobapplications as $jobapplication)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="job-item p-4 mb-4">
                                    <div class="row g-4">
                                        <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                            <img class="flex-shrink-0 img-fluid border rounded"
                                                src="{{ asset('storage/' . $jobapplication->image) }}" alt=""
                                                style="width: 80px; height: 80px;">
                                            <div class="text-start ps-4">
                                                <h5 class="mb-3">{{ $jobapplication->title }}</h5>
                                                <span class="text-truncate me-3"><i
                                                        class="fa fa-map-pin text-primary me-2"></i>{{ $jobapplication->location }}</span>
                                                <span class="text-truncate me-3"><i
                                                        class="far fa-clock text-primary me-2"></i>{{ $jobapplication->hour_type }}</span>
                                                <span class="text-truncate me-3"><i
                                                        class="far fa-building text-primary me-2"></i>{{ $jobapplication->employment_type }}</span>
                                                <span class="text-truncate me-3"><i
                                                        class="fas fa-graduation-cap text-primary me-2"></i>Minimal
                                                    {{ $jobapplication->education_level }}</span>
                                                <span class="text-truncate me-3"><i
                                                        class="fas fa-briefcase text-primary me-2"></i>{{ $jobapplication->experience_year }}</span>
                                                <span class="text-truncate me-0"><i
                                                        class="fas fa-money-bill-alt text-primary me-2"></i>Rp.
                                                    {{ number_format($jobapplication->salary_min, 0, ',', '.') }} -
                                                    Rp.
                                                    {{ number_format($jobapplication->salary_max, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                        <div
                                            class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                            <div class="d-flex mb-3">
                                                <a class="btn btn-secondary me-2" data-bs-toggle="collapse"
                                                    data-bs-target="#description-{{ $jobapplication->id }}"
                                                    aria-expanded="false"
                                                    aria-controls="description-{{ $jobapplication->id }}"
                                                    href="">Detail</a>
                                                <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#applyModal-{{ $jobapplication->id }}">Apply
                                                    Now</a>
                                            </div>
                                            <small class="text-truncate"><i
                                                    class="far fa-calendar-alt text-primary me-2"></i>Date Line:
                                                {{ \Carbon\Carbon::parse($jobapplication->created_at)->format('d-M-Y') }}</small>
                                        </div>
                                    </div>
                                    <div class="collapse mt-3" id="description-{{ $jobapplication->id }}">
                                        <fieldset class="border p-3 rounded">
                                            <legend class="float-none w-auto px-2">
                                                <h6>Persyaratan</h6>
                                            </legend>
                                            <span class="badge bg-primary me-2">Bekerja
                                                {{ $jobapplication->employment_type }}</span>
                                            <span class="badge bg-primary me-2">Usia
                                                {{ $jobapplication->age_level }}</span>
                                            <span class="badge bg-primary me-2">Minimal
                                                {{ $jobapplication->education_level }}</span>
                                            <span class="badge bg-primary me-2">Pengalaman
                                                {{ $jobapplication->experience_year }}</span>
                                        </fieldset>
                                        <fieldset class="border p-3 rounded">
                                            <legend class="float-none w-auto px-2">
                                                <h6>Deskripsi</h6>
                                            </legend>
                                            {!! $jobapplication->description !!}
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Apply Now -->
                        <div class="modal fade" id="applyModal-{{ $jobapplication->id }}"
                            aria-labelledby="applyModalLabel-{{ $jobapplication->id }}" aria-hidden="true"
                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                <form action="{{ route('job.apply', $jobapplication->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="applyModalLabel-{{ $jobapplication->id }}">
                                                Apply for {{ $jobapplication->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card-body">
                                                        <div class="mb-3">
                                                            <label for="inputAddress"><span
                                                                    class="text-danger">*</span>Nama
                                                                lengkap</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" placeholder="Masukan nama lengkap">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="inputAddress2"><span
                                                                    class="text-danger">*</span>Jenis
                                                                kelamin</label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="gender" value="Pria">
                                                                <label class="form-check-label"
                                                                    for="inlineRadio1">Pria</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="gender" value="Wanita">
                                                                <label class="form-check-label"
                                                                    for="inlineRadio2">Wanita</label>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 mb-3">
                                                            <div class="col-md-2">
                                                                <label for="inputEmail4"><span
                                                                        class="text-danger">*</span>Umur</label>
                                                                <input type="number" class="form-control" id="age"
                                                                    name="age">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label for="inputEmail4"><span
                                                                        class="text-danger">*</span>Email</label>
                                                                <input type="email" class="form-control" id="email"
                                                                    name="email" placeholder="@mail.com">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label class="form-inline" for="inputPassword4"><span
                                                                        class="text-danger">*</span>Phone
                                                                    <small class="form-text text-muted ml-2">
                                                                        *Nomor yang terhubung dengan
                                                                        Whatsapp
                                                                    </small>
                                                                </label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon1">62</span>
                                                                    <input type="text" class="form-control"
                                                                        id="phone_jobs" name="phone"
                                                                        oninput="validatePhoneNumber(this, 'phoneError-{{ $jobapplication->id }}')"
                                                                        required placeholder="ex: 812345678">
                                                                </div>
                                                                <div id="phoneError-{{ $jobapplication->id }}"
                                                                    class="text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="inputAddress"><span
                                                                    class="text-danger">*</span>Alamat</label>
                                                            <textarea class="form-control" name="address" id="editor"></textarea>
                                                        </div>
                                                        <div class="row g-3 mb-3">
                                                            <div class="form-group col-md-2">
                                                                <label for="inputState"><span
                                                                        class="text-danger">*</span>Pendidikan
                                                                    terakhir</label>
                                                                <input type="text" class="form-control"
                                                                    name="last_year_education" placeholder="Tahun..."
                                                                    required>
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <label class="form-inline" for="inputState">&nbsp;</label>
                                                                <input type="text" class="form-control"
                                                                    name="last_level_education"
                                                                    placeholder="ex: S1 Sistem Informasi" required>
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <label class="form-inline" for="inputState">&nbsp;</label>
                                                                <input type="text" class="form-control"
                                                                    name="last_education"
                                                                    placeholder="Nama sekolah atau universitas..."
                                                                    required>
                                                            </div>
                                                            <div id="last_educationError" class="text-danger">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3"
                                                            id="skills-container-{{ $jobapplication->id }}">
                                                            <label class="form-inline" for="inputAddress"><span
                                                                    class="text-danger">*</span>Skill
                                                                <small class="form-text text-muted ml-2">
                                                                    *Masukan satu atau lebih skill yang
                                                                    dikuasai
                                                                </small>
                                                            </label>
                                                            <div class="skill-input input-group">
                                                                <input type="text" class="form-control"
                                                                    id="skill-{{ $jobapplication->id }}" name="skill[]"
                                                                    placeholder="Masukan skill yang dikuasai">
                                                                <button class="btn btn-primary ml-1" type="button"
                                                                    onclick="addSkill('{{ $jobapplication->id }}')">Tambah
                                                                    Skill</button>
                                                            </div>
                                                        </div>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col-md-2">
                                                                <label for="inputState"><span
                                                                        class="text-danger">*</span>Posisi
                                                                    Terakhir</label>
                                                                <input type="text" class="form-control"
                                                                    name="last_year_position[]"
                                                                    placeholder="Dari tahun..." required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-inline" for="inputState">&nbsp;</label>
                                                                <input type="text" class="form-control"
                                                                    name="last_year_position[]"
                                                                    placeholder="Sampai tahun..." required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-inline" for="inputState">&nbsp;</label>
                                                                <input type="text" class="form-control"
                                                                    name="last_level_position" placeholder="Jabatan..."
                                                                    required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-inline" for="inputState">&nbsp;</label>
                                                                <input type="text" class="form-control"
                                                                    name="last_company" placeholder="Nama perusahaan..."
                                                                    required>
                                                                <div id="last_companyError" class="text-danger">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="inputAddress2"><span
                                                                    class="text-danger">*</span>Masih
                                                                Bekerja ?</label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="on_working" id="on_working" value="yes">
                                                                <label class="form-check-label"
                                                                    for="inlineRadio1">Ya</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="on_working" id="on_working" value="no">
                                                                <label class="form-check-label"
                                                                    for="inlineRadio2">Tidak</label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="inputAddress"><span
                                                                    class="text-danger">*</span>Siap Bekerja</label>
                                                            <input type="text" class="form-control"
                                                                id="ready_for_work" name="ready_for_work"
                                                                placeholder="ex: Segera/ 1 month notice/ Siap tanggal xx-xx-xxxx"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="inputAddress"><span
                                                                    class="text-danger">*</span>Pengalam
                                                                Bekerja Dibidangnya</label>
                                                            <input type="text" class="form-control" id="experience"
                                                                name="experience" placeholder="ex: 1 Tahun 3 Bulan"
                                                                required>
                                                        </div>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col-md-4">
                                                                <label for="inputState"><span
                                                                        class="text-danger">*</span>Ekspektasi
                                                                    gaji</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon1">Rp</span>
                                                                    <input type="number" class="form-control"
                                                                        id="salary" name="salary" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-inline" for="inputState"><span
                                                                        class="text-danger">*</span>Foto
                                                                    terbaru
                                                                    <small class="form-text text-muted ml-2">
                                                                        *file max. 1Mb
                                                                    </small>
                                                                </label>
                                                                <input type="file" class="form-control" id="image"
                                                                    name="image"
                                                                    onchange="validateFile(this, 'image', 'imageError-{{ $jobapplication->id }}')"
                                                                    required>
                                                                <div id="imageError-{{ $jobapplication->id }}"
                                                                    class="text-danger"></div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-inline" for="inputState"><span
                                                                        class="text-danger">*</span>Upload
                                                                    CV
                                                                    <small class="form-text text-muted ml-2">
                                                                        *Format file .pdf - max. 1Mb
                                                                    </small>
                                                                </label>
                                                                <input type="file" class="form-control" id="cv_file"
                                                                    name="cv"
                                                                    onchange="validateFile(this, 'cv_file', 'cvError-{{ $jobapplication->id }}')"
                                                                    required>
                                                                <div id="cvError-{{ $jobapplication->id }}"
                                                                    class="text-danger"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit
                                                Application</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- ##### About Us Area End ##### -->
@endsection
