// Enhanced Booking Form JavaScript
// ==========================================

$(document).ready(function() {
    
    // 📱 1. Real-time Phone Validation with International Format
    function initPhoneValidation() {
        const phoneInput = $('#phone');
        
        phoneInput.on('input', function() {
            const phone = $(this).val();
            const isValid = validateGeorgianPhone(phone);
            
            if (phone.length > 3) {
                if (isValid) {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    showValidationMessage($(this), '✅ სწორი ნომერი', 'success');
                } else {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    showValidationMessage($(this), '❌ არასწორი ფორმატი (+995XXXXXXXXX)', 'error');
                }
            }
        });
    }
    
    // 📧 2. Real-time Email Validation
    function initEmailValidation() {
        const emailInput = $('#email');
        
        emailInput.on('blur', function() {
            const email = $(this).val();
            
            if (email.length > 0) {
                if (isValidEmail(email)) {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    showValidationMessage($(this), '✅ სწორი ფორმატი', 'success');
                } else {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    showValidationMessage($(this), '❌ არასწორი Email ფორმატი', 'error');
                }
            }
        });
    }
    
    // ⏰ 3. Dynamic Time Slot Loading
    function initDynamicSlots() {
        const dateInput = $('#reservation_date');
        const timeSelect = $('#reservation_time');
        
        dateInput.on('change', function() {
            const selectedDate = $(this).val();
            const restaurantSlug = $('input[name="restaurant_slug"]').val();
            
            // Show loading state
            timeSelect.html('<option value="">⏳ იტვირთება...</option>').prop('disabled', true);
            
            // AJAX call to get available slots
            $.ajax({
                url: `/api/available-slots/${restaurantSlug}`,
                method: 'GET',
                data: { date: selectedDate },
                success: function(response) {
                    updateTimeSlots(response.slots);
                },
                error: function() {
                    timeSelect.html('<option value="">❌ შეცდომა</option>');
                }
            });
        });
    }
    
    // 🎯 4. Smart Guest Count Suggestions
    function initGuestCountSuggestions() {
        const guestInput = $('#guests_count');
        
        guestInput.on('change', function() {
            const count = parseInt($(this).val());
            
            if (count > 8) {
                showSuggestion('💡 დიდი ოჯახისთვის გირჩევთ წინასწარ დაკავშირებას რესტორანთან');
            } else if (count === 1) {
                showSuggestion('🍽️ ერთ ადამიანზე ბარის ზონა შესაძლოა იყოს ხელმისაწვდომი');
            }
        });
    }
    
    // 📅 5. Date Restrictions & Smart Suggestions
    function initDateValidation() {
        const dateInput = $('#reservation_date');
        const today = new Date().toISOString().split('T')[0];
        const maxDate = new Date();
        maxDate.setDate(maxDate.getDate() + 60); // 60 days in advance
        
        dateInput.attr('min', today);
        dateInput.attr('max', maxDate.toISOString().split('T')[0]);
        
        dateInput.on('change', function() {
            const selectedDate = new Date($(this).val());
            const dayOfWeek = selectedDate.getDay();
            
            // Weekend suggestions
            if (dayOfWeek === 0 || dayOfWeek === 6) {
                showSuggestion('🎉 შაბათ-კვირას მეტი დრო შეგიძლიათ დაატაროთ რესტორანში');
            }
            
            // Check for holidays
            checkHoliday(selectedDate);
        });
    }
    
    // 🔔 6. Form Progress Indicator
    function initProgressIndicator() {
        const formSteps = [
            '#reservation_date',
            '#reservation_time', 
            '#guests_count',
            '#name',
            '#phone'
        ];
        
        formSteps.forEach(selector => {
            $(selector).on('change input', function() {
                updateProgress();
            });
        });
        
        function updateProgress() {
            let completed = 0;
            formSteps.forEach(selector => {
                if ($(selector).val()) completed++;
            });
            
            const progress = (completed / formSteps.length) * 100;
            $('.progress-bar').css('width', progress + '%');
            
            if (progress === 100) {
                $('.submit-btn').removeClass('btn-secondary').addClass('btn-primary').prop('disabled', false);
            }
        }
    }
    
    // 💾 7. Auto-save Draft
    function initAutoSave() {
        const formInputs = $('input, select, textarea');
        
        formInputs.on('change input', function() {
            const formData = $('form').serialize();
            localStorage.setItem('reservation_draft', formData);
            showAutoSaveIndicator();
        });
        
        // Load draft on page load
        const savedDraft = localStorage.getItem('reservation_draft');
        if (savedDraft) {
            showDraftRestoreOption();
        }
    }
    
    // 🎨 8. Enhanced Visual Feedback
    function showValidationMessage(element, message, type) {
        const messageDiv = $(`<div class="validation-message ${type}">${message}</div>`);
        element.parent().find('.validation-message').remove();
        element.parent().append(messageDiv);
        
        setTimeout(() => messageDiv.fadeOut(), 3000);
    }
    
    function showSuggestion(message) {
        const suggestionDiv = $(`
            <div class="alert alert-info suggestion-alert">
                <i class="fas fa-lightbulb"></i> ${message}
            </div>
        `);
        
        $('.suggestions-container').html(suggestionDiv);
        setTimeout(() => suggestionDiv.fadeOut(), 5000);
    }
    
    // 🔧 Helper Functions
    function validateGeorgianPhone(phone) {
        // Georgian phone number patterns
        const patterns = [
            /^\+995\d{9}$/,           // +995XXXXXXXXX
            /^995\d{9}$/,             // 995XXXXXXXXX  
            /^5\d{8}$/,               // 5XXXXXXXX
            /^[2-7]\d{8}$/            // Local numbers
        ];
        
        return patterns.some(pattern => pattern.test(phone));
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function updateTimeSlots(slots) {
        const timeSelect = $('#reservation_time');
        
        timeSelect.prop('disabled', false).html('<option value="">-- აირჩიეთ დრო --</option>');
        
        if (slots.length === 0) {
            timeSelect.append('<option value="">😔 ხელმისაწვდომი დრო არ არის</option>');
            return;
        }
        
        slots.forEach(slot => {
            timeSelect.append(`<option value="${slot}">${slot}</option>`);
        });
    }
    
    function checkHoliday(date) {
        // Georgian holidays check
        const holidays = {
            '01-01': '🎊 ახალი წელი',
            '01-07': '⛪ ქრისტესშობა',
            '03-08': '🌸 ქალთა დღე',
            '04-09': '🇬🇪 ეროვნული დღე',
            '05-09': '🕊️ გამარჯვების დღე',
            '05-26': '🇬🇪 დამოუკიდებლობის დღე',
            '08-28': '⛪ მარიამობა',
            '10-14': '🍇 რთველი',
            '11-23': '🇬🇪 გიორგობა'
        };
        
        const dateKey = date.toISOString().split('T')[0].substring(5);
        
        if (holidays[dateKey]) {
            showSuggestion(`🎉 ${holidays[dateKey]} - ღია ადგილები შეზღუდული შეიძლება იყოს`);
        }
    }
    
    function showAutoSaveIndicator() {
        const indicator = $('.auto-save-indicator');
        indicator.text('💾 შენახულია').fadeIn().delay(1500).fadeOut();
    }
    
    function showDraftRestoreOption() {
        const restoreDiv = $(`
            <div class="alert alert-warning draft-restore">
                <strong>📝 შენახული ვერსია აღმოჩენილია</strong>
                <button type="button" class="btn btn-sm btn-outline-primary restore-draft">აღდგენა</button>
                <button type="button" class="btn btn-sm btn-outline-secondary clear-draft">გაწმენდა</button>
            </div>
        `);
        
        $('form').before(restoreDiv);
        
        $('.restore-draft').on('click', function() {
            // Implement draft restoration logic
            restoreFormData();
            $(this).closest('.draft-restore').fadeOut();
        });
        
        $('.clear-draft').on('click', function() {
            localStorage.removeItem('reservation_draft');
            $(this).closest('.draft-restore').fadeOut();
        });
    }
    
    // 🎯 9. Form Submission Enhancement
    function initFormSubmission() {
        $('form').on('submit', function(e) {
            const submitBtn = $('.submit-btn');
            
            // Disable double submission
            submitBtn.prop('disabled', true).html('⏳ მუშავდება...');
            
            // Clear draft after successful submission
            localStorage.removeItem('reservation_draft');
            
            // Add loading overlay
            $('body').append('<div class="loading-overlay"><div class="spinner"></div></div>');
        });
    }
    
    // 🚀 Initialize all enhancements
    function initializeBookingEnhancements() {
        initPhoneValidation();
        initEmailValidation();
        initDynamicSlots();
        initGuestCountSuggestions();
        initDateValidation();
        initProgressIndicator();
        initAutoSave();
        initFormSubmission();
        
        console.log('🎉 Booking form enhancements loaded successfully!');
    }
    
    // Start the magic
    initializeBookingEnhancements();
});

// 📱 PWA-style offline detection
window.addEventListener('online', function() {
    $('.offline-indicator').fadeOut();
    $('.form-container').removeClass('offline-mode');
});

window.addEventListener('offline', function() {
    const offlineDiv = $(`
        <div class="alert alert-warning offline-indicator">
            📶 ინტერნეტ კავშირი დაკარგულია. ფორმა ავტომატურად შეინახება.
        </div>
    `);
    $('body').prepend(offlineDiv);
    $('.form-container').addClass('offline-mode');
});
