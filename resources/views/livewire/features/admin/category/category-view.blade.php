<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary icon-left me-3">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <div>
                        <h3>Category Details</h3>
                        <p class="text-subtitle text-muted">Detailed information about the category.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end align-items-center">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning icon-left me-2">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">

                    <div class="card-header **bg-primary** text-white p-4">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-folder-open **fs-2**"></i>
                            <h4 class="card-title text-white mb-0">{{ $category->name }}</h4>
                        </div>
                        <p class="text-white-50 text-sm mt-1 mb-0">Category ID: #{{ $category->id }}</p>
                    </div>

                    <div class="card-body">

                        <div class="mb-5">
                            <h5
                                class="text-muted font-semibold mb-3 d-flex align-items-center gap-2 border-bottom pb-2">
                                <i class="bi bi-text-left text-primary"></i>
                                Description
                            </h5>
                            <div class="**bg-light** rounded **p-4**">
                                @if($category->description)
                                <p class="text-dark **lh-base**">{{ $category->description }}</p>
                                @else
                                <p class="text-muted fst-italic">No description provided.</p>
                                @endif
                            </div>
                        </div>

                        <div class="pt-3">
                            <h5
                                class="text-muted font-semibold mb-4 d-flex align-items-center gap-2 border-bottom pb-2">
                                <i class="bi bi-info-circle text-primary"></i>
                                Metadata
                            </h5>
                            <div class="row g-4">
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card shadow-none **bg-light-success** mb-0">
                                        <div class="card-body d-flex align-items-center p-3">
                                            <div class="p-3 **bg-success-light** rounded-3 me-3">
                                                <i class="bi bi-calendar-plus-fill text-success fs-5"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm text-muted mb-0">Created At</p>
                                                <p class="fw-bold text-dark mb-0 text-nowrap">
                                                    {{ $category->created_at->format('M d, Y') }}
                                                </p>
                                                <small class="text-muted">{{ $category->created_at->format('H:i A')
                                                    }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-3">
                                    <div class="card shadow-none **bg-light-primary** mb-0">
                                        <div class="card-body d-flex align-items-center p-3">
                                            <div class="p-3 **bg-primary-light** rounded-3 me-3">
                                                <i class="bi bi-calendar-check-fill text-primary fs-5"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm text-muted mb-0">Last Updated</p>
                                                <p class="fw-bold text-dark mb-0 text-nowrap">
                                                    {{ $category->updated_at->format('M d, Y') }}
                                                </p>
                                                <small class="text-muted">{{ $category->updated_at->format('H:i A')
                                                    }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-3">
                                    <div class="card shadow-none **bg-light-secondary** mb-0">
                                        <div class="card-body d-flex align-items-center p-3">
                                            <div class="p-3 **bg-secondary-light** rounded-3 me-3">
                                                <i class="bi bi-clock-history text-secondary fs-5"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm text-muted mb-0">Created</p>
                                                <p class="fw-bold text-dark mb-0">
                                                    {{ $category->created_at->diffForHumans() }}
                                                </p>
                                                <small class="text-muted">Ago</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-3">
                                    <div class="card shadow-none **bg-light-info** mb-0">
                                        <div class="card-body d-flex align-items-center p-3">
                                            <div class="p-3 **bg-info-light** rounded-3 me-3">
                                                <i class="bi bi-arrow-repeat text-info fs-5"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm text-muted mb-0">Updated</p>
                                                <p class="fw-bold text-dark mb-0">
                                                    {{ $category->updated_at->diffForHumans() }}
                                                </p>
                                                <small class="text-muted">Ago</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(method_exists($category, 'questions'))
                        <div class="border-top border-gray-200 pt-5 mt-5">
                            <h5
                                class="text-muted font-semibold mb-4 d-flex align-items-center gap-2 border-bottom pb-2">
                                <i class="bi bi-patch-question text-primary"></i>
                                Associated Questions
                            </h5>
                            <div class="card **bg-light-primary** shadow-none mb-0">
                                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-4xl font-bold text-primary mb-0">
                                            {{ $category->questions->count() }}
                                        </p>
                                        <p class="text-muted mb-0">Total Questions Linked to this Category</p>
                                    </div>
                                    <i class="bi bi-chat-square-text text-primary-light **fs-1**"></i>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="card-footer bg-white d-flex justify-content-between align-items-center border-top">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary icon-left">
                            <i class="bi bi-list"></i>
                            Back to List
                        </a>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary icon-left">
                            <i class="bi bi-pencil-square"></i>
                            Edit Category
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>