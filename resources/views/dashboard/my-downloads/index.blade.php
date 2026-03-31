@extends("layouts.app")

@section("title", "My Downloads")

@php
    $icons = [
        'twitter' => 'bi-twitter',
        'x' => 'bi-x',
        'facebook' => 'bi-facebook',
        'instagram' => 'bi-instagram',
        'tiktok' => 'fab-tiktok',
        'youtube' => 'bi-youtube',
    ];
    $iconColor = [
        'twitter' => 'text-blue-400',
        'x' => 'text-gray-800',
        'facebook' => 'text-blue-600',
        'instagram' => 'text-pink-500',
        'tiktok' => 'text-gray-800',
        'youtube' => 'text-red-500',
    ];
@endphp

@section("content")
    <div class="flex h-screen">
        <x-sidebar />
        <main id="main-content" class="flex-1 flex flex-col overflow-hidden">
            <x-dashboard.download.header />
            <div id="main-dashboard" class="flex-1 overflow-auto p-6">
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-medium text-gray-900">My Downloads</h3>
                        <span class="text-sm text-gray-500">{{ $downloads->total() }} total</span>
                    </div>

                    @if($downloads->isEmpty())
                        <div class="text-center py-12">
                            <x-fas-folder-open class="w-12 h-12 text-gray-300 mx-auto mb-4" />
                            <p class="text-gray-500">You don't have any downloads yet.</p>
                            <a href="{{ route('download') }}" class="btn btn-primary btn-sm mt-4">
                                Start Downloading
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Platform</th>
                                        <th>Format</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($downloads as $media)
                                        <tr class="hover">
                                            <td>
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 bg-gradient-to-br from-pink-400 to-purple-500 rounded-lg flex items-center justify-center">
                                                        @if(isset($icons[$media->socialNetwork?->slug]))
                                                            <x-dynamic-component
                                                                component="{{ $icons[$media->socialNetwork?->slug] }}"
                                                                class="{{ $iconColor[$media->socialNetwork?->slug] }} h-4 w-4"
                                                            />
                                                        @endif
                                                    </div>
                                                    <span class="font-medium text-gray-900">
                                                        {{ ucfirst($media->socialNetwork?->slug ?? 'Unknown') }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-ghost">{{ strtoupper($media->format ?? '-') }}</span>
                                            </td>
                                            <td>
                                                @php
                                                    $statusClasses = match($media->status) {
                                                        App\Enums\MediaStatus::Success => 'bg-green-100 text-green-800',
                                                        App\Enums\MediaStatus::Failed => 'bg-red-100 text-red-800',
                                                        default => 'bg-yellow-100 text-yellow-800',
                                                    };
                                                @endphp
                                                <span class="px-2 py-1 {{ $statusClasses }} text-xs rounded-full">
                                                    {{ ucfirst($media->status->value) }}
                                                </span>
                                            </td>
                                            <td class="text-sm text-gray-500">
                                                {{ $media->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td>
                                                <div class="flex items-center gap-1">
                                                    @if($media->status === App\Enums\MediaStatus::Failed)
                                                        <button
                                                            class="btn-retry btn btn-ghost btn-sm text-orange-500 hover:text-orange-700"
                                                            data-media-id="{{ $media->id }}"
                                                            title="Retry download"
                                                        >
                                                            <x-heroicon-o-arrow-path class="w-4 h-4" />
                                                        </button>
                                                    @endif
                                                    @if($media->s3_url || $media->original_url)
                                                        <a
                                                            href="{{ $media->s3_url ?? $media->original_url }}"
                                                            target="_blank"
                                                            class="btn btn-ghost btn-sm"
                                                        >
                                                            <x-eva-download-outline class="w-4 h-4" />
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-center mt-6">
                            {{ $downloads->links('vendor.pagination.daisy') }}
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-retry[data-media-id]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const mediaId = this.dataset.mediaId;
                const row = this.closest('tr');
                const csrfToken = document.querySelector("meta[name='csrf-token']").content;

                fetch(`/api/media/${mediaId}/retry`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    credentials: 'same-origin',
                }).then(r => r.json()).then(data => {
                    const badge = row.querySelector('.rounded-full');
                    badge.className = 'px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full';
                    badge.textContent = 'Pending';
                    btn.remove();
                }).catch(() => {
                    alert('Erro ao reenviar a midia.');
                });
            });
        });
    });
</script>
@endpush
