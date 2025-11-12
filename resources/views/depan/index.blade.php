<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Portofolio & Resume</title>
        <link rel="icon" type="image/png" href={{ asset('depan-icon.png') }} />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('depan')}}/css/styles.css" rel="stylesheet" />


        <link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />

    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none">{{ $about->judul }}</span>
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="{{ asset('foto') . '/' . get_meta_value('_foto') }}" alt="..." style="width: 10rem; height: 10rem; object-fit: cover;" /></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About me</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#education">Education</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#project">Projects</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#skills">Skills</a></li>
                    {{-- Cek apakah $interest ada DAN isinya tidak kosong kalo kosong sembunyikan tombolnya --}}
                    @if($award && !empty(trim(strip_tags($interest->isi))))
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#interests">Interests</a></li>
                    @endif
                    {{-- Cek apakah $award ada DAN isinya tidak kosong --}}
                    @if($award && !empty(trim(strip_tags($award->isi))))
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#awards">Certificates</a></li>
                    @endif
                </ul>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- About-->
            <section class="resume-section" id="about">
                <div class="resume-section-content">
                    <h1 class="mb-0">
                        {!! set_about_nama($about->judul) !!}
                    </h1>
                    {{-- info profile --}}
                    <div class="subheading mb-5 contact-info">
                        <span><i class="fas fa-map-marker-alt me-2"></i>{{ get_meta_value('_kota') }}, {{ get_meta_value('_provinsi') }}</span>
                        <span><i class="fas fa-phone me-2"></i>{{ get_meta_value('_nohp') }}</span>
                        <span><i class="fas fa-envelope me-2"></i>
                            <a href="mailto:{{ get_meta_value('_email') }}" target="_blank" rel="noopener noreferrer">{{ get_meta_value('_email') }}</a>
                        </span>
                    </div>
                    {{-- link medsos --}}
                    <div class="lead mb-5">{!! $about->isi !!}</div>   {{--  data dari form summernote --}}
                    <div class="social-icons">
                        <a class="social-icon" href="{{ get_meta_value('_linkedin') }}" target="_blank"  rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a>
                        <a class="social-icon" href="{{ get_meta_value('_github') }}" target="_blank"  rel="noopener noreferrer"><i class="fab fa-github"></i></a>
                        <a class="social-icon" href="{{ get_meta_value('_instagram') }}" target="_blank"  rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                        <a class="social-icon" href="{{ get_meta_value('_facebook') }}" target="_blank"  rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                        <a class="social-icon" href="{{ get_meta_value('_whatsapp') }}" target="_blank"  rel="noopener noreferrer"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Experience-->
            <section class="resume-section" id="experience">
                <div class="resume-section-content">
                    <h2 class="mb-5">Experience</h2>
                    @foreach ($experience as $item)
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">{{ $item->judul }}</h3>
                            <div class="subheading mb-3">{{ $item->info1 }}</div>
                            {!! $item->isi !!}
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">{{ $item->tgl_mulai_indo }} - {{ $item->tgl_akhir_indo }}</span></div>
                    </div>
                    @endforeach
                </div>
            </section>
            <hr class="m-0" />
            <!-- Education-->
            <section class="resume-section" id="education">
                <div class="resume-section-content">
                    <h2 class="mb-5"></i>Education</h2>
                    @foreach ($education as $item)
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">{{ $item->judul }}</h3>
                            <div class="subheading mb-3">{{ $item->info1 }}</div>
                            <div>{{ $item->info2 }}</div>
                            <p>{{ $item->info3 }}</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">{{ $item->tgl_mulai_indo }} - {{ $item->tgl_akhir_indo }}</span></div>
                    </div>
                    @endforeach
                </div>
            </section>
            <hr class="m-0" />
            <!-- Projects -->
            <section class="resume-section" id="project">
                <div class="resume-section-content">
                <h2 class="mb-5">Projects</h2>
                    <div class="row" id="project-list">
                    @foreach ($project as $index => $item)
                    <div class="col-md-6 col-lg-4 mb-4 project-item {{ $index >= 6 ? 'd-none' : '' }}">
                        <div class="card shadow-sm border-0 rounded-3 h-100">
                            @if ($item->images->count() > 0)
                                <img src="{{ asset('foto_project/' . $item->images->first()->gambar) }}"
                                    class="card-img-top rounded-top"
                                    alt="{{ $item->judul }}"
                                    style="height: 200px; width: 100%; object-fit: cover;">
                            @else
                                <div style="height: 200px; background-color: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d;">
                                    No Image
                                </div>
                            @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <p class="card-text text-muted mb-2"><small>{{ $item->informasi }}</small></p>
                            <p class="card-text">
                                {{ Str::limit(strip_tags($item->isi), 100, '...') }}
                            </p>
                            <div class="mt-auto">
                                <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#projectModal{{ $item->id }}">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </button>

                                @if ($item->link)
                                    <a href="{{ $item->link }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-external-link-alt me-1"></i> Visit
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="projectModal{{ $item->id }}" tabindex="-1" aria-labelledby="projectModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="projectModalLabel{{ $item->id }}">{{ $item->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if ($item->images->count() > 0)
                                    <div id="carouselProject{{ $item->id }}" class="carousel slide mb-3" data-bs-ride="carousel">
                                        <div class="carousel-indicators">         {{-- tanda _ _ _ --}}
                                            @foreach ($item->images as $imgIndex => $image)
                                                <button type="button"
                                                    data-bs-target="#carouselProject{{ $item->id }}"
                                                    data-bs-slide-to="{{ $imgIndex }}"
                                                    class="{{ $imgIndex == 0 ? 'active' : '' }}"
                                                    aria-current="{{ $imgIndex == 0 ? 'true' : 'false' }}"
                                                    aria-label="Slide {{ $imgIndex + 1 }}">
                                                </button>
                                            @endforeach
                                        </div>
                                        <div class="carousel-inner rounded">        {{-- tanda < > --}}
                                            @foreach ($item->images as $imgIndex => $image)
                                                <div class="carousel-item {{ $imgIndex == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('foto_project/' . $image->gambar) }}"
                                                        class="d-block w-100 rounded"
                                                        alt="{{ $item->judul }}"
                                                        style="height: 400px; object-fit: contain; background-color: #dee2e6;">
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($item->images->count() > 1)
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProject{{ $item->id }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselProject{{ $item->id }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        @endif
                                    </div>
                                @endif
                                <h6 class="text-muted mb-3">{{ $item->informasi }}</h6>
                                <div class="project-description">
                                    {!! $item->isi !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                @if ($item->link)
                                    <a href="{{ $item->link }}" target="_blank" class="btn btn-primary">
                                        <i class="fas fa-external-link-alt me-1"></i> Visit Website
                                    </a>
                                @endif
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
                @if ($project->count() > 6)
                    <div class="text-center mt-4">
                        <button id="loadMoreBtn" class="btn btn-primary px-5 py-2">Load More</button>
                    </div>
                @endif
                </div>
            </section>
            <hr class="m-0" />

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const loadMoreBtn = document.getElementById('loadMoreBtn');

                    // Cek apakah tombol ada (jika project <= 6, tombol tidak akan dirender)
                    if (loadMoreBtn) {
                        loadMoreBtn.addEventListener('click', function() {
                            // Ambil semua elemen project yang masih punya class 'd-none'
                            const hiddenProjects = document.querySelectorAll('#project-list .project-item.d-none');

                            // Loop untuk menampilkan 3 project berikutnya
                            for (let i = 0; i < 3 && i < hiddenProjects.length; i++) {
                                hiddenProjects[i].classList.remove('d-none');
                                // Opsional: Tambahkan class untuk animasi fade-in jika diinginkan
                                hiddenProjects[i].style.opacity = 0;
                                setTimeout(() => {
                                    hiddenProjects[i].style.transition = 'opacity 0.5s';
                                    hiddenProjects[i].style.opacity = 1;
                                }, 50 * i);
                            }

                            // Cek lagi sisa project yang tersembunyi
                            const remainingHidden = document.querySelectorAll('#project-list .project-item.d-none').length;
                            if (remainingHidden === 0) {
                                // Jika sudah habis, sembunyikan tombol Load More
                                loadMoreBtn.style.display = 'none';
                            }
                        });
                    }
                });
            </script>
            <hr class="m-0" />
            <!-- Skills-->
            <section class="resume-section" id="skills">
                <div class="resume-section-content">
                    <h2 class="mb-5">Skills</h2>
                    <div class="subheading mb-3">Programming Languages & Tools</div>
                    <ul class="list-inline dev-icons">
                        @foreach (explode(', ', get_meta_value('_language')) as $item)
                        {{-- <li class="list-inline-item"><i class="devicon-{{ strtolower($item) }}-plain"></i></li> --}}
                        <li class="list-inline-item" title="{{ ucfirst($item) }}"><i class="devicon-{{ strtolower($item) }}-plain"></i></li>     {{--title="{{ ucfirst($item) }}" ketika logo skill disentuh/hover maka keluar nama2nya--}}
                        @endforeach
                    </ul>
                    <div class="subheading mb-3">Workflow</div>
                    {!! set_list_workflow(get_meta_value('_workflow')) !!}
                </div>
            </section>
            <!-- Interests-->
        @if($interest && !empty(trim(strip_tags($interest->isi))))
            <hr class="m-0" />
            <section class="resume-section" id="interests">
                <div class="resume-section-content">
                    <h2 class="mb-5">{{ $interest->judul }}</h2>
                    {!! set_list_award($interest->isi) !!}
                </div>
            </section>
        @endif
            <!-- Awards-->
        @if($award && !empty(trim(strip_tags($award->isi))))
            <hr class="m-0" />
            <section class="resume-section" id="awards">
                <div class="resume-section-content">
                    <h2 class="mb-5">{{ $award->judul }}</h2>
                    {!! set_list_award($award->isi) !!}
                </div>
            </section>
        @endif
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('depan')}}/js/scripts.js"></script>
    </body>
</html>
