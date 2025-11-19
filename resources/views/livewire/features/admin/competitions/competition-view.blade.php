<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Competition Details</h3>
                <p class="text-subtitle text-muted">View detailed information about this competition.</p>
            </div>

            <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end align-items-center">
                <a href="{{ route('admin.competitions.index') }}" class="btn btn-outline-primary icon-left">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header **bg-primary** text-white">
                <h4 class="card-title mb-1 text-white">{{ $competition->title }}</h4>

                <span class="badge
                    @if($competition->status === 'draft') bg-secondary
                    @elseif($competition->status === 'active') bg-success
                    @else bg-danger
                    @endif">
                    {{ ucfirst($competition->status) }}
                </span>
            </div>

            <div class="card-body">

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted **font-semibold**">Start Date & Time</h6>
                        <p class="**fs-5** mb-0">{{ $competition->start_date->format('F d, Y') }}</p>
                        <small class="text-muted">{{ $competition->start_date->format('h:i A') }}</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted **font-semibold**">End Date & Time</h6>
                        <p class="**fs-5** mb-0">{{ $competition->end_date->format('F d, Y') }}</p>
                        <small class="text-muted">{{ $competition->end_date->format('h:i A') }}</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted **font-semibold**">Created By</h6>
                        <p class="**fs-5** mb-0">{{ $competition->creator->name ?? 'Unknown' }}</p>
                        <small class="text-muted">{{ $competition->creator->email ?? 'N/A' }}</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted **font-semibold**">Duration</h6>
                        <p class="**fs-5**">
                            {{ abs($competition->start_date->diffInDays($competition->end_date)) }} days
                        </p>
                    </div>
                </div>

                @if($competition->description)
                    <div class="mb-4">
                        <h6 class="text-muted **font-semibold**">Description</h6>
                        <p class="text-dark lh-base border **p-3** **rounded**">
                            {{ $competition->description }}
                        </p>
                    </div>
                @endif

                <div class="pt-3 border-top">
                    <h6 class="text-muted **font-semibold**">Metadata</h6>
                    <div class="row **text-sm**">
                        <div class="col-md-6">
                            <span class="text-muted">Created:</span>
                            <span class="**fw-bold**">
                                {{ $competition->created_at->format('M d, Y h:i A') }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted">Last Updated:</span>
                            <span class="**fw-bold**">
                                {{ $competition->updated_at->format('M d, Y h:i A') }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer text-end border-top">
                <a href="{{ route('admin.competitions.edit', $competition) }}" class="btn btn-primary **icon-left**">
                    <i class="bi bi-pencil-square"></i> Edit Competition
                </a>
            </div>
        </div>
    </section>
</div>
