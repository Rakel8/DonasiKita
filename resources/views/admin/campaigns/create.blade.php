<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Kampanye - DonasiKita</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: #333;
        }
        
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #1a1a2e;
            color: white;
            overflow-y: auto;
            z-index: 100;
        }
        
        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        
        .sidebar-title {
            font-size: 16px;
            font-weight: 700;
        }
        
        .sidebar-nav {
            list-style: none;
            padding: 20px 0;
        }
        
        .sidebar-nav a {
            color: #bbb;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .sidebar-nav a:hover {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border-left-color: #667eea;
        }
        
        .sidebar-nav a.active {
            background: rgba(102, 126, 234, 0.2);
            color: #667eea;
            border-left-color: #667eea;
            font-weight: 600;
        }
        
        .sidebar-nav i {
            width: 20px;
            margin-right: 10px;
        }
        
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
        }
        
        .user-name {
            font-size: 13px;
            color: #bbb;
        }
        
        .logout-btn {
            width: 100%;
            padding: 10px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: #c0392b;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 25px;
            min-height: 100vh;
        }
        
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .page-title h1 {
            font-size: 28px;
            margin: 0;
        }
        
        .page-title p {
            color: #999;
            font-size: 14px;
            margin: 5px 0 0;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .card-header {
            padding: 20px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .card-title {
            font-size: 16px;
            font-weight: 700;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
            font-size: 14px;
        }
        
        .form-label .required {
            color: #e74c3c;
        }
        
        .form-control,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }
        
        .form-control:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .form-control.error,
        .form-textarea.error,
        .form-select.error {
            border-color: #e74c3c;
        }
        
        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .image-upload-section {
            border: 2px dashed #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .image-upload-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .upload-tab {
            padding: 10px 15px;
            border: none;
            background: none;
            cursor: pointer;
            color: #999;
            font-weight: 600;
            font-size: 13px;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }
        
        .upload-tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }
        
        .upload-content {
            display: none;
        }
        
        .upload-content.active {
            display: block;
        }
        
        .image-preview {
            width: 100%;
            max-width: 300px;
            height: 200px;
            border: 2px dashed #e0e0e0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }
        
        .image-preview:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }
        
        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        
        .image-preview.empty {
            color: #999;
        }
        
        .image-input {
            display: none;
        }
        
        .form-buttons {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 6px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
            padding: 10px 30px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .form-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-heart"></i>
            </div>
            <div class="sidebar-title">DonasiKita</div>
        </div>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.campaigns.index') }}" class="active">
                    <i class="fas fa-list"></i> Kampanye
                </a>
            </li>
            <li>
                <a href="{{ route('admin.donations.index') }}">
                    <i class="fas fa-credit-card"></i> Donasi
                </a>
            </li>
            <li>
                <a href="{{ route('admin.donors.index') }}">
                    <i class="fas fa-users"></i> Donatur
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-chart-bar"></i> Laporan
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="user-name">
                    {{ auth()->user()->name }}
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="page-title">
                <h1>Buat Kampanye Baru</h1>
                <p>Tambahkan kampanye penggalangan dana baru</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-plus"></i> Form Kampanye Baru
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.campaigns.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="form-label">Judul Kampanye <span class="required">*</span></label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            class="form-control @error('title') error @enderror"
                            value="{{ old('title') }}"
                            placeholder="Masukkan judul kampanye"
                            required
                        >
                        @error('title')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi <span class="required">*</span></label>
                        <textarea 
                            id="description" 
                            name="description" 
                            class="form-textarea @error('description') error @enderror"
                            placeholder="Deskripsikan kampanye secara detail"
                            required
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="target_amount" class="form-label">Target Dana (Rp) <span class="required">*</span></label>
                            <input 
                                type="number" 
                                id="target_amount" 
                                name="target_amount" 
                                class="form-control @error('target_amount') error @enderror"
                                value="{{ old('target_amount') }}"
                                placeholder="0"
                                min="10000"
                                step="1000"
                                required
                            >
                            @error('target_amount')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="end_date" class="form-label">Tanggal Akhir <span class="required">*</span></label>
                            <input 
                                type="date" 
                                id="end_date" 
                                name="end_date" 
                                class="form-control @error('end_date') error @enderror"
                                value="{{ old('end_date') }}"
                                required
                            >
                            @error('end_date')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Image Upload Section -->
                    <div class="form-group">
                        <label class="form-label">Gambar Kampanye</label>
                        <div class="image-upload-section">
                            <!-- Tabs -->
                            <div class="image-upload-tabs">
                                <button type="button" class="upload-tab active" onclick="switchTab('file')">
                                    <i class="fas fa-upload"></i> Upload File
                                </button>
                                <button type="button" class="upload-tab" onclick="switchTab('link')">
                                    <i class="fas fa-link"></i> Dari Link
                                </button>
                            </div>

                            <!-- Tab: Upload File -->
                            <div id="file-content" class="upload-content active">
                                <div class="image-preview empty" id="imagePreview" onclick="document.getElementById('image').click();">
                                    <div style="text-align: center;">
                                        <i class="fas fa-cloud-upload-alt" style="font-size: 32px; color: #ddd;"></i>
                                        <p style="margin-top: 10px; font-size: 13px;">Klik atau drag gambar ke sini</p>
                                    </div>
                                </div>
                                <input 
                                    type="file" 
                                    id="image" 
                                    name="image" 
                                    class="image-input" 
                                    accept="image/*"
                                    onchange="previewImage(this)"
                                >
                                <small style="color: #999;">Format: JPG, PNG, GIF (Max 2MB)</small>
                            </div>

                            <!-- Tab: Link Gambar -->
                            <div id="link-content" class="upload-content">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label for="image_url" class="form-label">URL Gambar</label>
                                    <input 
                                        type="url" 
                                        id="image_url" 
                                        name="image_url" 
                                        class="form-control"
                                        value="{{ old('image_url') }}"
                                        placeholder="https://example.com/gambar.jpg"
                                    >
                                    <small style="color: #999; display: block; margin-top: 8px;">Masukkan URL lengkap gambar dari internet</small>
                                </div>
                            </div>
                        </div>
                        @error('image')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        @error('image_url')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">Status <span class="required">*</span></label>
                        <select 
                            id="status" 
                            name="status" 
                            class="form-select @error('status') error @enderror"
                            required
                        >
                            <option value="">-- Pilih Status --</option>
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                            <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-plus"></i> Buat Kampanye
                        </button>
                        <a href="{{ route('admin.campaigns.index') }}" class="btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
                    preview.classList.remove('empty');
                };
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        function switchTab(tab) {
            // Hide all contents
            document.getElementById('file-content').classList.remove('active');
            document.getElementById('link-content').classList.remove('active');
            
            // Remove active from all tabs
            document.querySelectorAll('.upload-tab').forEach(t => t.classList.remove('active'));
            
            // Show selected content
            if (tab === 'file') {
                document.getElementById('file-content').classList.add('active');
                document.querySelectorAll('.upload-tab')[0].classList.add('active');
            } else {
                document.getElementById('link-content').classList.add('active');
                document.querySelectorAll('.upload-tab')[1].classList.add('active');
            }
        }

        // Drag and drop
        const imagePreview = document.getElementById('imagePreview');
        
        imagePreview.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#667eea';
            this.style.background = 'rgba(102, 126, 234, 0.05)';
        });
        
        imagePreview.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#e0e0e0';
            this.style.background = '#f8f9fa';
        });
        
        imagePreview.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#e0e0e0';
            this.style.background = '#f8f9fa';
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('image').files = files;
                previewImage(document.getElementById('image'));
            }
        });
    </script>
</body>
</html>
