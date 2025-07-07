@extends('user.layouts.layout')

@section('title', 'User Profile')

@push('styles')
<style>
    /* ...existing code from profile_show.blade.php styles... */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body {
        background-color: #f4f4f4;
        min-height: 100vh;
    }
    .container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 0 20px;
    }
    .profile-header {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 30px;
    }
    .profile-pic {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        background-color: #ddd;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }
    .profile-pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .profile-pic .edit-icon {
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: #4a90e2;
        color: white;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        font-size: 18px;
    }
    .profile-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .profile-info h2 {
        font-size: 24px;
        margin-bottom: 5px;
    }
    .profile-info p {
        color: #666;
        margin-bottom: 15px;
    }
    .edit-profile-btn {
        background-color: transparent;
        border: 1px solid #4a90e2;
        color: #4a90e2;
        padding: 8px 15px;
        border-radius: 5px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        align-self: flex-start;
        text-decoration: none;
    }
    .edit-profile-btn:hover {
        background-color: #4a90e2;
        color: white;
    }
    .profile-content {
        margin-top: 30px;
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 30px;
    }
    .profile-sidebar {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        height: fit-content;
    }
    .sidebar-menu {
        list-style: none;
    }
    .sidebar-menu li {
        margin-bottom: 10px;
    }
    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .sidebar-menu a:hover {
        background-color: #f4f4f4;
    }
    .sidebar-menu a.active {
        background-color: #e6f0ff;
        color: #4a90e2;
        font-weight: 500;
    }
    .sidebar-menu i {
        font-size: 20px;
    }
    .profile-main {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .section-title {
        font-size: 20px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
    }
    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }
    .form-control:focus {
        border-color: #4a90e2;
        outline: none;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .success-alert {
        padding: 12px;
        background-color: #d4edda;
        color: #155724;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .tab-content {
        display: none;
    }
    .tab-content.active {
        display: block;
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
    .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 30px;
        border-radius: 10px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    .close-modal {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
    .close-modal:hover {
        color: #333;
    }
    .modal-title {
        font-size: 24px;
        margin-bottom: 20px;
    }
    .file-upload {
        margin-bottom: 20px;
    }
    .upload-btn {
        display: inline-block;
        background-color: #f4f4f4;
        border: 1px solid #ddd;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }
    .upload-btn:hover {
        background-color: #e6e6e6;
    }
    @media (max-width: 992px) {
        .profile-content {
            grid-template-columns: 1fr;
        }
        .profile-sidebar {
            margin-bottom: 20px;
        }
    }
    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }
        .edit-profile-btn {
            align-self: center;
        }
        .form-row {
            grid-template-columns: 1fr;
            gap: 10px;
        }
        .profile-main {
            padding: 20px;
        }
    }
    @media (max-width: 480px) {
        .container {
            margin: 15px auto;
            padding: 0 15px;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
        }
        .modal-content {
            padding: 20px;
            margin: 10% auto;
            width: 95%;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    @if(session('success'))
        <div class="success-alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="profile-header">
        <div class="profile-pic">
            <img src="{{ $user->profile_image_url }}" alt="Profile Picture" id="profile-image">
            <div class="edit-icon" id="edit-profile-pic">
                <i class="fas fa-camera"></i>
            </div>
        </div>
        <div class="profile-info">
            <h2 id="user-name">{{ $user->name }}</h2>
            <p id="user-email">{{ $user->email }}</p>
            <a href="{{ route('profile.edit') }}" class="edit-profile-btn">Edit Profile</a>
        </div>
    </div>
    <div class="profile-content">
        <div class="profile-sidebar">
            <ul class="sidebar-menu">
                <li><a href="{{ route('profile.show') }}" class="active"><i class="fas fa-user"></i> Personal Information</a></li>
                <li><a href="{{ route('profile.orders') }}"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
                <li><a href="#password-section"><i class="fas fa-lock"></i> Change Password</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </form>
                </li>
            </ul>
        </div>
        <div class="profile-main">
            <div class="section-title">Account Information</div>
            <div class="form-group">
                <label>Full Name</label>
                <input class="form-control" type="text" value="{{ $user->name }}" readonly>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" value="{{ $user->email }}" readonly>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input class="form-control" type="text" value="{{ $user->phone_number ?? '-' }}" readonly>
            </div>
            @if($user->date_of_birth)
            <div class="form-group">
                <label>Date of Birth</label>
                <input class="form-control" type="text" value="{{ $user->date_of_birth->format('M d, Y') }}" readonly>
            </div>
            @endif
            @if($user->full_address)
            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" rows="3" readonly>{{ $user->full_address }}</textarea>
            </div>
            @endif
            <div id="password-section" style="margin-top: 40px;">
                <div class="section-title">Change Password</div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('profile.password.update') }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label>Current Password</label>
                        <input class="form-control" type="password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="profile-image-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2 class="modal-title">Update Profile Image</h2>
        <form id="profile-image-form" enctype="multipart/form-data">
            @csrf
            <div class="file-upload">
                <label>Choose new profile image:</label>
                <input type="file" name="profile_image" accept="image/*" required>
                <div class="upload-btn">
                    <i class="fas fa-upload"></i> Select Image
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Upload Image</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('profile-image-modal');
    const editIcon = document.getElementById('edit-profile-pic');
    const closeModal = document.querySelector('.close-modal');
    const form = document.getElementById('profile-image-form');
    if (editIcon) {
        editIcon.addEventListener('click', function() {
            modal.style.display = 'block';
        });
    }
    if(closeModal) {
        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    }
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
    if(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            fetch('{{ route("profile.image.update") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('profile-image').src = data.image_url;
                    modal.style.display = 'none';
                    const successAlert = document.createElement('div');
                    successAlert.className = 'success-alert';
                    successAlert.textContent = data.message;
                    document.querySelector('.container').insertBefore(successAlert, document.querySelector('.profile-header'));
                    setTimeout(() => successAlert.remove(), 5000);
                }
            })
            .catch(error => {
                alert('An error occurred while uploading the image.');
            });
        });
    }
    const fileInput = document.querySelector('input[type="file"]');
    const uploadBtn = document.querySelector('.upload-btn');
    if(uploadBtn) {
        uploadBtn.addEventListener('click', function() {
            fileInput.click();
        });
    }
    if(fileInput) {
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                uploadBtn.innerHTML = '<i class="fas fa-check"></i> ' + this.files[0].name;
            }
        });
    }
});
</script>
@endpush
