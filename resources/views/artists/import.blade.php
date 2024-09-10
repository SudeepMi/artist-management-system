@extends('layout.app')

@section('main')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Import Artist</h2>

    <form action="{{ route('artists.import.save') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label for="file-upload" class="block text-sm font-medium text-gray-700">Upload CSV</label>
            <div id="drop-zone" class="mt-1 flex justify-center items-center p-4 border-2 border-dashed rounded-md text-gray-600 hover:border-blue-500 hover:text-blue-500 cursor-pointer">
                <p id="drop-zone-text">Drag and drop your file here or click to upload</p>
            </div>
            <input type="file" id="file-upload" name="file" accept=".csv, .xlsx, .xls" class="hidden" required>

            <!-- File Name Display -->
            <p id="file-name" class="mt-2 text-sm text-gray-500 hidden"></p>

            @error('file')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Import Artists
            </button>
        </div>
    </form>
</div>


<script>
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-upload');
    const fileNameDisplay = document.getElementById('file-name');
    const dropZoneText = document.getElementById('drop-zone-text');

    // Click to upload file
    dropZone.addEventListener('click', () => fileInput.click());

    // Drag over effect
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('border-blue-500', 'text-blue-500');
    });

    // Remove drag over effect
    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('border-blue-500', 'text-blue-500');
    });

    // Handle file drop
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-blue-500', 'text-blue-500');
        fileInput.files = e.dataTransfer.files;
        displayFileName(fileInput.files[0].name);
    });

    // Display file name when selected via file dialog
    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            displayFileName(fileInput.files[0].name);
        }
    });

    // Function to display file name
    function displayFileName(fileName) {
        fileNameDisplay.textContent = `File selected: ${fileName}`;
        fileNameDisplay.classList.remove('hidden');
        dropZoneText.textContent = "File successfully loaded";
    }
</script>
@endsection