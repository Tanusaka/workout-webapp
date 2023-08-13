<!--begin::Layout-->
<div class="d-flex flex-column flex-lg-row">
    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
        <!--begin::Card-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Summary-->
                <!--begin::User Info-->
                <div class="d-flex flex-center flex-column py-5">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-100px symbol-circle mb-7">
                        <img src="assets/media/avatars/blank.png" alt="image" />
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Name-->
                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3"><?= $user->firstname.' '.$user->lastname; ?></a>
                    <!--end::Name-->
                    <!--begin::Position-->
                    <div class="mb-9">
                        <!--begin::Badge-->
                        <div class="badge badge-lg badge-light-primary d-inline"><?= $user->rolename; ?></div>
                        <!--begin::Badge-->
                    </div>
                    <!--end::Position-->
                    <!--begin::Info-->
                    <!--begin::Info heading-->

                    <!--end::Info heading-->
    
                    <!--end::Info-->
                </div>
                <!--end::User Info-->
                <!--end::Summary-->
                <!--begin::Details toggle-->
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details
                    <span class="ms-2 rotate-180">
                        <i class="ki-duotone ki-down fs-3"></i>
                    </span></div>
                    <!-- Edit User Details -->
                </div>
                <!--end::Details toggle-->
                <div class="separator"></div>
                <!--begin::Details content-->
                <div id="kt_user_view_details" class="collapse show">
                    <div class="pb-5 fs-6">
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Account ID</div>
                        <div class="text-gray-600"><?= 'ID-'.$user->id; ?></div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Email</div>
                        <div class="text-gray-600">
                            <a href="#" class="text-gray-600 text-hover-primary"><?= $user->email; ?></a>
                        </div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Address</div>
                        <div class="text-gray-600">
                        <br />
                        <br /></div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Last Login</div>
                        <div class="text-gray-600"><?= $user->lastinat; ?></div>
                        <!--begin::Details item-->
                    </div>
                </div>
                <!--end::Details content-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
        <!--begin::Connected Accounts-->

        <!--end::Connected Accounts-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-15">
        <!--begin:::Tabs-->
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_user_view_overview_tab">Overview</a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_overview_security">Security</a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_user_view_overview_events_and_logs_tab">Events & Logs</a>
            </li>
            <!--end:::Tab item-->
        </ul>
        <!--end:::Tabs-->
        <!--begin:::Tab content-->
        <div class="tab-content" id="myTabContent">
            <!--begin:::Tab pane-->
            <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                <!--begin::Card-->
                <div class="card card-flush mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header mt-6">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h2 class="mb-1">User's Schedule</h2>
                            <div class="fs-6 fw-semibold text-muted">2 upcoming meetings</div>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_schedule">
                            <i class="ki-duotone ki-brush fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Add Schedule</button>
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body p-9 pt-4">
                        <!--begin::Dates-->
                        <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2">
                            <!--begin::Date-->
                            <li class="nav-item me-1">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_0">
                                    <span class="opacity-50 fs-7 fw-semibold">Su</span>
                                    <span class="fs-6 fw-bolder">21</span>
                                </a>
                            </li>
                            <!--end::Date-->
                            <!--begin::Date-->
                            <li class="nav-item me-1">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary active" data-bs-toggle="tab" href="#kt_schedule_day_1">
                                    <span class="opacity-50 fs-7 fw-semibold">Mo</span>
                                    <span class="fs-6 fw-bolder">22</span>
                                </a>
                            </li>
                            <!--end::Date-->
                            <!--begin::Date-->
                            <li class="nav-item me-1">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_2">
                                    <span class="opacity-50 fs-7 fw-semibold">Tu</span>
                                    <span class="fs-6 fw-bolder">23</span>
                                </a>
                            </li>
                            <!--end::Date-->
                            <!--begin::Date-->
                            <li class="nav-item me-1">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_3">
                                    <span class="opacity-50 fs-7 fw-semibold">We</span>
                                    <span class="fs-6 fw-bolder">24</span>
                                </a>
                            </li>
                            <!--end::Date-->
                            <!--begin::Date-->
                            <li class="nav-item me-1">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_4">
                                    <span class="opacity-50 fs-7 fw-semibold">Th</span>
                                    <span class="fs-6 fw-bolder">25</span>
                                </a>
                            </li>
                            <!--end::Date-->
                            <!--begin::Date-->
                            <li class="nav-item me-1">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_5">
                                    <span class="opacity-50 fs-7 fw-semibold">Fr</span>
                                    <span class="fs-6 fw-bolder">26</span>
                                </a>
                            </li>
                            <!--end::Date-->
                            <!--begin::Date-->
                            <li class="nav-item me-1">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_6">
                                    <span class="opacity-50 fs-7 fw-semibold">Sa</span>
                                    <span class="fs-6 fw-bolder">27</span>
                                </a>
                            </li>
                            <!--end::Date-->
                            <!--begin::Date-->
                            <li class="nav-item me-1">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_7">
                                    <span class="opacity-50 fs-7 fw-semibold">Su</span>
                                    <span class="fs-6 fw-bolder">28</span>
                                </a>
                            </li>
                            <!--end::Date-->
                            <!--begin::Date-->
                            <li class="nav-item me-1">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_8">
                                    <span class="opacity-50 fs-7 fw-semibold">Mo</span>
                                    <span class="fs-6 fw-bolder">29</span>
                                </a>
                            </li>
                            <!--end::Date-->
                            <!--begin::Date-->
                            <li class="nav-item me-1">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_9">
                                    <span class="opacity-50 fs-7 fw-semibold">Tu</span>
                                    <span class="fs-6 fw-bolder">30</span>
                                </a>
                            </li>
                            <!--end::Date-->
                            <!--begin::Date-->
                            <li class="nav-item me-1">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_10">
                                    <span class="opacity-50 fs-7 fw-semibold">We</span>
                                    <span class="fs-6 fw-bolder">31</span>
                                </a>
                            </li>
                            <!--end::Date-->
                        </ul>
                        <!--end::Dates-->
                        <!--begin::Tab Content-->
                        <div class="tab-content">
                            <!--begin::Day-->
                            <div id="kt_schedule_day_0" class="tab-pane fade show">
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">9:00 - 10:00
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Yannis Gloverson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">9:00 - 10:00
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Karina Clarke</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">13:00 - 14:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Sales Pitch Proposal</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Karina Clarke</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">16:30 - 17:30
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Sales Pitch Proposal</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Walter White</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">11:00 - 11:45
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Michael Walters</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                            </div>
                            <!--end::Day-->
                            <!--begin::Day-->
                            <div id="kt_schedule_day_1" class="tab-pane fade show active">
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">10:00 - 11:00
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Caleb Donaldson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">11:00 - 11:45
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Sales Pitch Proposal</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Peter Marcus</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">14:30 - 15:30
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Caleb Donaldson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">16:30 - 17:30
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Sales Pitch Proposal</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Bob Harris</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                            </div>
                            <!--end::Day-->
                            <!--begin::Day-->
                            <div id="kt_schedule_day_2" class="tab-pane fade show">
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">12:00 - 13:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Sean Bean</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">14:30 - 15:30
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Walter White</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">9:00 - 10:00
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Karina Clarke</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">14:30 - 15:30
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Bob Harris</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                            </div>
                            <!--end::Day-->
                            <!--begin::Day-->
                            <div id="kt_schedule_day_3" class="tab-pane fade show">
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">12:00 - 13:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Karina Clarke</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">14:30 - 15:30
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Karina Clarke</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">11:00 - 11:45
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Yannis Gloverson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                            </div>
                            <!--end::Day-->
                            <!--begin::Day-->
                            <div id="kt_schedule_day_4" class="tab-pane fade show">
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">13:00 - 14:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Mark Randall</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">9:00 - 10:00
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Bob Harris</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">11:00 - 11:45
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Sales Pitch Proposal</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Terry Robins</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">10:00 - 11:00
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Kendell Trevor</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                            </div>
                            <!--end::Day-->
                            <!--begin::Day-->
                            <div id="kt_schedule_day_5" class="tab-pane fade show">
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">12:00 - 13:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Yannis Gloverson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">13:00 - 14:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Committee Review Approvals</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Yannis Gloverson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">12:00 - 13:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Peter Marcus</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">13:00 - 14:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">David Stevenson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                            </div>
                            <!--end::Day-->
                            <!--begin::Day-->
                            <div id="kt_schedule_day_6" class="tab-pane fade show">
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">10:00 - 11:00
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Project Review & Testing</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">David Stevenson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">16:30 - 17:30
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Michael Walters</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">13:00 - 14:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Bob Harris</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                            </div>
                            <!--end::Day-->
                            <!--begin::Day-->
                            <div id="kt_schedule_day_7" class="tab-pane fade show">
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">14:30 - 15:30
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Bob Harris</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">13:00 - 14:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Kendell Trevor</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">12:00 - 13:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Committee Review Approvals</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Bob Harris</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">12:00 - 13:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Caleb Donaldson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                            </div>
                            <!--end::Day-->
                            <!--begin::Day-->
                            <div id="kt_schedule_day_8" class="tab-pane fade show">
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">9:00 - 10:00
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Committee Review Approvals</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Yannis Gloverson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">14:30 - 15:30
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Karina Clarke</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">12:00 - 13:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Walter White</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">11:00 - 11:45
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Project Review & Testing</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Bob Harris</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                            </div>
                            <!--end::Day-->
                            <!--begin::Day-->
                            <div id="kt_schedule_day_9" class="tab-pane fade show">
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">10:00 - 11:00
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Committee Review Approvals</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Yannis Gloverson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">12:00 - 13:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Project Review & Testing</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Terry Robins</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">16:30 - 17:30
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Caleb Donaldson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                            </div>
                            <!--end::Day-->
                            <!--begin::Day-->
                            <div id="kt_schedule_day_10" class="tab-pane fade show">
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">11:00 - 11:45
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Kendell Trevor</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">13:00 - 14:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Yannis Gloverson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">16:30 - 17:30
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Kendell Trevor</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">9:00 - 10:00
                                        <span class="fs-7 text-muted text-uppercase">am</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Project Review & Testing</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Caleb Donaldson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                                <!--begin::Time-->
                                <div class="d-flex flex-stack position-relative mt-6">
                                    <!--begin::Bar-->
                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                    <!--end::Bar-->
                                    <!--begin::Info-->
                                    <div class="fw-semibold ms-5">
                                        <!--begin::Time-->
                                        <div class="fs-7 mb-1">12:00 - 13:00
                                        <span class="fs-7 text-muted text-uppercase">pm</span></div>
                                        <!--end::Time-->
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                        <!--end::Title-->
                                        <!--begin::User-->
                                        <div class="fs-7 text-muted">Lead by
                                        <a href="#">Yannis Gloverson</a></div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Time-->
                            </div>
                            <!--end::Day-->
                        </div>
                        <!--end::Tab Content-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Tasks-->
                <div class="card card-flush mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header mt-6">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h2 class="mb-1">User's Tasks</h2>
                            <div class="fs-6 fw-semibold text-muted">Total 25 tasks in backlog</div>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_task">
                            <i class="ki-duotone ki-add-files fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>Add Task</button>
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-column">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center position-relative mb-7">
                            <!--begin::Label-->
                            <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                            <!--end::Label-->
                            <!--begin::Details-->
                            <div class="fw-semibold ms-5">
                                <a href="#" class="fs-5 fw-bold text-dark text-hover-primary">Create FureStibe branding logo</a>
                                <!--begin::Info-->
                                <div class="fs-7 text-muted">Due in 1 day
                                <a href="#">Karina Clark</a></div>
                                <!--end::Info-->
                            </div>
                            <!--end::Details-->
                            <!--begin::Menu-->
                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-setting-3 fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </button>
                            <!--begin::Task menu-->
                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Update Status</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Menu separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Menu separator-->
                                <!--begin::Form-->
                                <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-6 fw-semibold">Status:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid" name="task_status" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="3">In Process</option>
                                            <option value="4">Rejected</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-users-update-task-status="reset">Reset</button>
                                        <button type="submit" class="btn btn-sm btn-primary" data-kt-users-update-task-status="submit">
                                            <span class="indicator-label">Apply</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Task menu-->
                            <!--end::Menu-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center position-relative mb-7">
                            <!--begin::Label-->
                            <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                            <!--end::Label-->
                            <!--begin::Details-->
                            <div class="fw-semibold ms-5">
                                <a href="#" class="fs-5 fw-bold text-dark text-hover-primary">Schedule a meeting with FireBear CTO John</a>
                                <!--begin::Info-->
                                <div class="fs-7 text-muted">Due in 3 days
                                <a href="#">Rober Doe</a></div>
                                <!--end::Info-->
                            </div>
                            <!--end::Details-->
                            <!--begin::Menu-->
                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-setting-3 fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </button>
                            <!--begin::Task menu-->
                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Update Status</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Menu separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Menu separator-->
                                <!--begin::Form-->
                                <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-6 fw-semibold">Status:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid" name="task_status" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="3">In Process</option>
                                            <option value="4">Rejected</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-users-update-task-status="reset">Reset</button>
                                        <button type="submit" class="btn btn-sm btn-primary" data-kt-users-update-task-status="submit">
                                            <span class="indicator-label">Apply</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Task menu-->
                            <!--end::Menu-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center position-relative mb-7">
                            <!--begin::Label-->
                            <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                            <!--end::Label-->
                            <!--begin::Details-->
                            <div class="fw-semibold ms-5">
                                <a href="#" class="fs-5 fw-bold text-dark text-hover-primary">9 Degree Project Estimation</a>
                                <!--begin::Info-->
                                <div class="fs-7 text-muted">Due in 1 week
                                <a href="#">Neil Owen</a></div>
                                <!--end::Info-->
                            </div>
                            <!--end::Details-->
                            <!--begin::Menu-->
                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-setting-3 fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </button>
                            <!--begin::Task menu-->
                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Update Status</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Menu separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Menu separator-->
                                <!--begin::Form-->
                                <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-6 fw-semibold">Status:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid" name="task_status" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="3">In Process</option>
                                            <option value="4">Rejected</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-users-update-task-status="reset">Reset</button>
                                        <button type="submit" class="btn btn-sm btn-primary" data-kt-users-update-task-status="submit">
                                            <span class="indicator-label">Apply</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Task menu-->
                            <!--end::Menu-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center position-relative mb-7">
                            <!--begin::Label-->
                            <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                            <!--end::Label-->
                            <!--begin::Details-->
                            <div class="fw-semibold ms-5">
                                <a href="#" class="fs-5 fw-bold text-dark text-hover-primary">Dashboard UI & UX for Leafr CRM</a>
                                <!--begin::Info-->
                                <div class="fs-7 text-muted">Due in 1 week
                                <a href="#">Olivia Wild</a></div>
                                <!--end::Info-->
                            </div>
                            <!--end::Details-->
                            <!--begin::Menu-->
                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-setting-3 fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </button>
                            <!--begin::Task menu-->
                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Update Status</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Menu separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Menu separator-->
                                <!--begin::Form-->
                                <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-6 fw-semibold">Status:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid" name="task_status" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="3">In Process</option>
                                            <option value="4">Rejected</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-users-update-task-status="reset">Reset</button>
                                        <button type="submit" class="btn btn-sm btn-primary" data-kt-users-update-task-status="submit">
                                            <span class="indicator-label">Apply</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Task menu-->
                            <!--end::Menu-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center position-relative">
                            <!--begin::Label-->
                            <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                            <!--end::Label-->
                            <!--begin::Details-->
                            <div class="fw-semibold ms-5">
                                <a href="#" class="fs-5 fw-bold text-dark text-hover-primary">Mivy App R&D, Meeting with clients</a>
                                <!--begin::Info-->
                                <div class="fs-7 text-muted">Due in 2 weeks
                                <a href="#">Sean Bean</a></div>
                                <!--end::Info-->
                            </div>
                            <!--end::Details-->
                            <!--begin::Menu-->
                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-setting-3 fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </button>
                            <!--begin::Task menu-->
                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Update Status</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Menu separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Menu separator-->
                                <!--begin::Form-->
                                <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-6 fw-semibold">Status:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid" name="task_status" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="3">In Process</option>
                                            <option value="4">Rejected</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-users-update-task-status="reset">Reset</button>
                                        <button type="submit" class="btn btn-sm btn-primary" data-kt-users-update-task-status="submit">
                                            <span class="indicator-label">Apply</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Task menu-->
                            <!--end::Menu-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Tasks-->
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="kt_user_view_overview_security" role="tabpanel">

            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="kt_user_view_overview_events_and_logs_tab" role="tabpanel">

            </div>
            <!--end:::Tab pane-->
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Content-->
</div>
<!--end::Layout-->