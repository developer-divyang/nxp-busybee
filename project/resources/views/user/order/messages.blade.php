@foreach($messages as $message)
<div class="file-item">
    <div class="file-info">
        <div class="img-file-info">
            <span class="files-icon">
                <img src="{{ asset('assets/front/images/file.png') }}" alt="file icon">
            </span>
            <span class="file-name">{{ $message->comment ?? 'No comment' }}</span>
        </div>
        @if($message->file_path)
        <a href="{{ Storage::url($message->file_path) }}" target="_blank" class="download-btn">
            <img src="{{ asset('assets/front/images/downloadIcon.png') }}" alt="download icon"> Download
        </a>
        @endif
    </div>
    <div class="file-meta">
        <span>{{ $message->created_at->format('d/m/Y h:i A') }}</span> |
        
        @if($message->user_id == 1)
        <span class="file-user">Admin</span>
        @else
        <span class="file-user">{{ $message->user->name }}</span>
        @endif

    </div>
</div>
@endforeach