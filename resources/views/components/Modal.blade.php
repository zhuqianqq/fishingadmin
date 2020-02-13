<div class="modal fade" tabindex="-1" role="dialog" id="{{ $id }}">
    <div class="modal-dialog" role="document" style="
        margin-left: auto;
        margin-right: auto;
        max-width: {{ $max_width ?? '800px' }}">
        <div class="modal-content">
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>