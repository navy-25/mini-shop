<!-- Form -->
<div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form" action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalFormLabel">Form {{ $page['title'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="status" class="form-label required w-100">Status</label>
                            <select name="status" id="status" class="form-control select2">
                                <option value=""></option>
                                @foreach (statusCategory() as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label optional">Banner</label>
                        <a href="#" class="">
                            <img src="{{ asset('app-assets/image/default-3-1.png') }}" id="thumbnail-upload-img" class="uploadedThumbnail mb-2" alt="profile image" width="100%" style="aspect-ratio:3/1 !important" />
                        </a>
                        <div class="d-flex">
                            <p class="mb-1">
                                Tipe file:
                                <span class="badge bg-warning text-dark" style="font-weight: normal !important">png</span>
                                <span class="badge bg-warning text-dark" style="font-weight: normal !important">jpg</span>
                                <span class="badge bg-warning text-dark" style="font-weight: normal !important">jpeg</span>
                            </p>
                            <label for="thumbnail-upload" class="btn btn-sm btn-danger mb-75 ms-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="unggah foto" style="font-size:10px !important">
                                Unggah
                            </label>
                            <input type="file" id="thumbnail-upload" name="banner" hidden accept="image/*" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="btn_submit" class="btn btn-sm btn-danger">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Form --}}
