<div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Arrastra y suelta el archivo">
    <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
    </div>
    <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
        <span class="qq-upload-drop-area-text-selector"></span>
    </div>
    <div class="qq-upload-button-selector qq-upload-button" style="margin-left: 40%; width: 21%;">
        <div>Selecciona el archivo</div>
    </div>
    <span class="qq-drop-processing-selector qq-drop-processing">
        <span>Procesando el archivo...</span>
        <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
    </span>
    <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
        <li>
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
            <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
            <span class="qq-upload-file-selector qq-upload-file"></span>
            <span class="qq-upload-size-selector qq-upload-size"></span>
            <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancelar</button>
            <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Reintentar</button>
            <button type="button" id="eliminarImagenForm" class="qq-btn qq-upload-delete-selector qq-upload-delete" onclick="eliminarImagen()">Eliminar</button>
            <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
        </li>
    </ul>

    <dialog class="qq-alert-dialog-selector">
        <div class="qq-dialog-message-selector"></div>
        <div class="qq-dialog-buttons">
            <button type="button" class="qq-cancel-button-selector">Cerrar</button>
        </div>
    </dialog>

    <dialog class="qq-confirm-dialog-selector">
        <div class="qq-dialog-message-selector"></div>
        <div class="qq-dialog-buttons">
            <button type="button" class="qq-cancel-button-selector">No</button>
            <button type="button" class="qq-ok-button-selector">Si</button>
        </div>
    </dialog>

    <dialog class="qq-prompt-dialog-selector">
        <div class="qq-dialog-message-selector"></div>
        <input type="text">
        <div class="qq-dialog-buttons">
            <button type="button" class="qq-cancel-button-selector">Cancelar</button>
            <button type="button" class="qq-ok-button-selector">Confirmar</button>
        </div>
    </dialog>
</div>