@extends('user.layouts.app')

@section('title', 'Notification Settings')

@push('styles')
<style>
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
        max-width: 800px;
        margin: 30px auto;
        padding: 0 20px;
    }

    .page-header {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-header h1 {
        color: #333;
        font-size: 28px;
        font-weight: 600;
    }

    .back-btn {
        background: linear-gradient(135deg, #6c757d, #545b62);
        color: white;
        text-decoration: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background: linear-gradient(135deg, #545b62, #3d4145);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
        color: white;
        text-decoration: none;
    }

    .notifications-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .notifications-header {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
        padding: 25px 30px;
    }

    .notifications-header h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 600;
    }

    .notifications-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }

    .notifications-body {
        padding: 40px 30px;
    }

    .alert {
        padding: 15px;
        margin-bottom: 25px;
        border-radius: 8px;
        font-weight: 500;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    .notification-section {
        margin-bottom: 40px;
        padding-bottom: 30px;
        border-bottom: 2px solid #e1e5e9;
    }

    .notification-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .section-title {
        font-size: 20px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #17a2b8;
        font-size: 24px;
    }

    .notification-option {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 15px;
        border: 1px solid #e1e5e9;
        transition: all 0.3s ease;
    }

    .notification-option:hover {
        background-color: #e9ecef;
        border-color: #17a2b8;
    }

    .option-info {
        flex: 1;
    }

    .option-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .option-description {
        color: #666;
        font-size: 14px;
        line-height: 1.4;
    }

    .toggle-switch {
        position: relative;
        width: 60px;
        height: 30px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 30px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #17a2b8;
    }

    input:checked + .slider:before {
        transform: translateX(30px);
    }

    .frequency-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
    }

    .frequency-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
    }

    .frequency-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
    }

    .frequency-option {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .frequency-option input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: #17a2b8;
    }

    .frequency-option label {
        font-size: 14px;
        color: #333;
        cursor: pointer;
    }

    .save-section {
        background-color: #f8f9fa;
        padding: 25px 30px;
        border-top: 2px solid #e1e5e9;
        text-align: center;
    }

    .btn {
        display: inline-block;
        padding: 12px 30px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #138496, #117a8b);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
    }

    .privacy-note {
        background-color: #e7f3ff;
        border: 1px solid #b3d9ff;
        border-radius: 8px;
        padding: 20px;
        margin-top: 30px;
    }

    .privacy-note h4 {
        color: #0056b3;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .privacy-note p {
        color: #0056b3;
        font-size: 14px;
        line-height: 1.5;
        margin: 0;
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 15px;
        }

        .page-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .notifications-body {
            padding: 30px 20px;
        }

        .notification-option {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .frequency-options {
            grid-template-columns: 1fr;
        }

        .save-section {
            padding: 20px 15px;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Notification Settings</h1>
        <a href="{{ route('profile.show') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Profile
        </a>
    </div>

    <div class="notifications-container">
        <div class="notifications-header">
            <h2><i class="fas fa-bell"></i> Notification Preferences</h2>
            <p>Manage how you receive notifications from us</p>
        </div>

        <div class="notifications-body">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.notifications.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Email Notifications -->
                <div class="notification-section">
                    <h3 class="section-title">
                        <i class="fas fa-envelope"></i>
                        Email Notifications
                    </h3>

                    <div class="notification-option">
                        <div class="option-info">
                            <div class="option-title">Order Updates</div>
                            <div class="option-description">
                                Receive email notifications about your order status, shipping updates, and delivery confirmations.
                            </div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="email_notifications" value="1" 
                                   {{ old('email_notifications', $user->email_notifications ?? true) ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="notification-option">
                        <div class="option-info">
                            <div class="option-title">Promotional Emails</div>
                            <div class="option-description">
                                Get notified about special offers, new products, sales, and exclusive deals.
                            </div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="promotional_emails" value="1" 
                                   {{ old('promotional_emails', $user->promotional_emails ?? false) ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="notification-option">
                        <div class="option-info">
                            <div class="option-title">Security Alerts</div>
                            <div class="option-description">
                                Important security notifications about your account, login attempts, and password changes.
                            </div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="security_emails" value="1" 
                                   {{ old('security_emails', $user->security_emails ?? true) ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <!-- SMS Notifications -->
                <div class="notification-section">
                    <h3 class="section-title">
                        <i class="fas fa-sms"></i>
                        SMS Notifications
                    </h3>

                    <div class="notification-option">
                        <div class="option-info">
                            <div class="option-title">Order SMS Updates</div>
                            <div class="option-description">
                                Receive SMS notifications for critical order updates and delivery notifications.
                            </div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="sms_notifications" value="1" 
                                   {{ old('sms_notifications', $user->sms_notifications ?? false) ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="notification-option">
                        <div class="option-info">
                            <div class="option-title">Security SMS</div>
                            <div class="option-description">
                                SMS alerts for important security events like password changes and suspicious login attempts.
                            </div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="security_sms" value="1" 
                                   {{ old('security_sms', $user->security_sms ?? true) ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <!-- Push Notifications -->
                <div class="notification-section">
                    <h3 class="section-title">
                        <i class="fas fa-mobile-alt"></i>
                        Push Notifications
                    </h3>

                    <div class="notification-option">
                        <div class="option-info">
                            <div class="option-title">Browser Push Notifications</div>
                            <div class="option-description">
                                Receive push notifications in your browser for real-time updates.
                            </div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="push_notifications" value="1" 
                                   {{ old('push_notifications', $user->push_notifications ?? true) ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="notification-option">
                        <div class="option-info">
                            <div class="option-title">Cart Reminders</div>
                            <div class="option-description">
                                Get reminded about items left in your cart and limited-time offers.
                            </div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="cart_reminders" value="1" 
                                   {{ old('cart_reminders', $user->cart_reminders ?? false) ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <!-- Email Frequency -->
                <div class="notification-section">
                    <h3 class="section-title">
                        <i class="fas fa-clock"></i>
                        Email Frequency
                    </h3>

                    <div class="frequency-section">
                        <div class="frequency-title">How often would you like to receive promotional emails?</div>
                        <div class="frequency-options">
                            <div class="frequency-option">
                                <input type="radio" id="daily" name="email_frequency" value="daily" 
                                       {{ old('email_frequency', $user->email_frequency ?? 'weekly') == 'daily' ? 'checked' : '' }}>
                                <label for="daily">Daily</label>
                            </div>
                            <div class="frequency-option">
                                <input type="radio" id="weekly" name="email_frequency" value="weekly" 
                                       {{ old('email_frequency', $user->email_frequency ?? 'weekly') == 'weekly' ? 'checked' : '' }}>
                                <label for="weekly">Weekly</label>
                            </div>
                            <div class="frequency-option">
                                <input type="radio" id="monthly" name="email_frequency" value="monthly" 
                                       {{ old('email_frequency', $user->email_frequency ?? 'weekly') == 'monthly' ? 'checked' : '' }}>
                                <label for="monthly">Monthly</label>
                            </div>
                            <div class="frequency-option">
                                <input type="radio" id="never" name="email_frequency" value="never" 
                                       {{ old('email_frequency', $user->email_frequency ?? 'weekly') == 'never' ? 'checked' : '' }}>
                                <label for="never">Never</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="privacy-note">
                    <h4><i class="fas fa-shield-alt"></i> Privacy & Data</h4>
                    <p>
                        We respect your privacy and will only send you notifications you've opted into. 
                        You can change these settings at any time. We never share your contact information 
                        with third parties for marketing purposes.
                    </p>
                </div>
            </form>
        </div>

        <div class="save-section">
            <button type="submit" form="notifications-form" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Notification Settings
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add form id to the form for the submit button outside the form
        const form = document.querySelector('form');
        if (form) {
            form.id = 'notifications-form';
        }

        // Add interactivity to toggle switches
        const toggles = document.querySelectorAll('.toggle-switch input');
        toggles.forEach(toggle => {
            toggle.addEventListener('change', function() {
                // You can add immediate feedback here if needed
                console.log(`${this.name} changed to ${this.checked}`);
            });
        });

        // Email frequency logic
        const emailToggle = document.querySelector('input[name="email_notifications"]');
        const frequencySection = document.querySelector('.frequency-section');
        const promotionalToggle = document.querySelector('input[name="promotional_emails"]');
        
        function updateFrequencyVisibility() {
            if (emailToggle && frequencySection) {
                if (emailToggle.checked && promotionalToggle.checked) {
                    frequencySection.style.opacity = '1';
                    frequencySection.style.pointerEvents = 'auto';
                } else {
                    frequencySection.style.opacity = '0.5';
                    frequencySection.style.pointerEvents = 'none';
                }
            }
        }

        if (emailToggle && promotionalToggle) {
            emailToggle.addEventListener('change', updateFrequencyVisibility);
            promotionalToggle.addEventListener('change', updateFrequencyVisibility);
            
            // Initial check
            updateFrequencyVisibility();
        }

        console.log('Notification settings page loaded');
    });
</script>
@endpush
