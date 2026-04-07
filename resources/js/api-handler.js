/**
 * API Handler - Intercept form submissions and route to API
 */

const apiDebugMode = new URLSearchParams(window.location.search).has('debugApi')
    || window.localStorage.getItem('debugApi') === '1';

console.log('✓ API Handler loaded successfully');

document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 DOM ready. Setting up form interceptors...');
    
    // Handle muallaf form submissions
    const muallafForm = document.querySelector('form[action*="muallafs"]');
    
    if (muallafForm) {
        console.log('📝 Muallaf form found:', muallafForm.getAttribute('action'));
        
        muallafForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            console.log('🚀 Form submitted. Intercepting...');
            
            const formData = new FormData(muallafForm);
            const method = formData.get('_method')?.toUpperCase() || 'POST';
            const action = muallafForm.getAttribute('action');
            
            // Determine if it's create or update based on form action
            const isUpdate = action.includes('/edit') || method === 'PUT' || method === 'PATCH';
            const muallafId = extractMuallafId(action);
            
            // Build API endpoint
            const apiEndpoint = isUpdate 
                ? `/api/muallafs/${muallafId}`
                : '/api/muallafs';
            
            console.log(`📡 Routing to API: ${method} ${apiEndpoint}`);
            
            // Prepare request data
            const requestData = {};
            for (let [key, value] of formData) {
                if (key !== '_token' && key !== '_method') {
                    requestData[key] = value;
                }
            }
            
            console.log('📦 Payload:', requestData);
            
            try {
                showLoadingState(true);
                console.log('⏳ Loading state: ON');
                
                const response = await fetch(apiEndpoint, {
                    method: isUpdate ? 'PUT' : 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': formData.get('_token'),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(requestData),
                });
                
                console.log(`📨 Response received: Status ${response.status}`);
                
                const result = await response.json();
                console.log('✅ JSON parsed:', result);
                persistLastApiCall(apiEndpoint, isUpdate ? 'PUT' : 'POST', response.status, result);
                
                if (response.ok) {
                    // Success
                    console.log('✓ API call successful');
                    showSuccessMessage(result.message || 'Operasi berjaya.');

                    if (apiDebugMode) {
                        console.log('Debug mode aktif: redirect dihentikan untuk semakan Network.');
                    } else {
                        console.log('🔄 Redirecting to /muallafs in 1.5s...');
                        setTimeout(() => {
                            console.log('→ Navigating to /muallafs');
                            window.location.href = '/muallafs';
                        }, 1500);
                    }
                } else {
                    // Validation error or server error
                    console.warn('⚠️ API error:', result);
                    showErrorMessage(result.message || 'Ralat berlaku.');
                    displayValidationErrors(result.errors || {});
                }
            } catch (error) {
                console.error('❌ Network error:', error);
                showErrorMessage('Ralat rangkaian: ' + error.message);
            } finally {
                showLoadingState(false);
                console.log('⏳ Loading state: OFF');
            }
        });
    } else {
        console.warn('⚠️ Muallaf form not found on this page');
    }
    
    // Handle delete actions
    setupDeleteHandlers();
});

/**
 * Extract muallaf ID from form action URL
 */
function extractMuallafId(action) {
    const match = action.match(/\/(\d+)(?:\/edit)?$/);
    return match ? match[1] : null;
}

/**
 * Setup delete button handlers
 */
function setupDeleteHandlers() {
    document.querySelectorAll('form[action*="muallafs"][method="POST"]').forEach(form => {
        const methodInput = form.querySelector('input[name="_method"]');
        
        if (methodInput && methodInput.value === 'DELETE') {
            console.log('🗑️ Delete form found:', form.getAttribute('action'));
            
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                if (!confirm('Adakah anda pasti untuk padam rekod ini?')) {
                    console.log('Cancel delete action');
                    return;
                }
                
                const muallafId = extractMuallafId(form.getAttribute('action'));
                const formData = new FormData(form);
                
                console.log(`🚀 Delete submitted for ID: ${muallafId}`);
                
                try {
                    showLoadingState(true);
                    
                    const response = await fetch(`/api/muallafs/${muallafId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token'),
                            'Accept': 'application/json',
                        },
                    });
                    
                    console.log(`📨 Delete response: Status ${response.status}`);
                    
                    const result = await response.json();
                    console.log('✅ Response parsed:', result);
                    persistLastApiCall(`/api/muallafs/${muallafId}`, 'DELETE', response.status, result);
                    
                    if (response.ok) {
                        showSuccessMessage(result.message || 'Muallaf berjaya dipadam.');
                        if (apiDebugMode) {
                            console.log('Debug mode aktif: redirect dihentikan untuk semakan Network.');
                        } else {
                            console.log('🔄 Redirecting to /muallafs in 1.5s...');
                            setTimeout(() => {
                                window.location.href = '/muallafs';
                            }, 1500);
                        }
                    } else {
                        console.warn('⚠️ Delete error:', result);
                        showErrorMessage(result.message || 'Ralat semasa padam.');
                    }
                } catch (error) {
                    console.error('❌ Delete network error:', error);
                    showErrorMessage('Ralat rangkaian: ' + error.message);
                } finally {
                    showLoadingState(false);
                }
            });
        }
    });
}

/**
 * Show/hide loading state
 */
function showLoadingState(isLoading) {
    const buttons = document.querySelectorAll('button[type="submit"]');
    buttons.forEach(btn => {
        btn.disabled = isLoading;
        if (isLoading) {
            btn.textContent = '⏳ Sila tunggu...';
            btn.classList.add('opacity-50');
        } else {
            btn.textContent = btn.dataset.originalText || btn.textContent;
            btn.classList.remove('opacity-50');
        }
    });
}

/**
 * Show success message
 */
function showSuccessMessage(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'fixed top-4 right-4 p-4 bg-green-50 border border-green-200 rounded-lg shadow-lg';
    alertDiv.innerHTML = `
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">${message}</p>
            </div>
        </div>
    `;
    document.body.appendChild(alertDiv);
    
    setTimeout(() => alertDiv.remove(), 3000);
}

/**
 * Show error message
 */
function showErrorMessage(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'fixed top-4 right-4 p-4 bg-red-50 border border-red-200 rounded-lg shadow-lg';
    alertDiv.innerHTML = `
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-red-800">${message}</p>
            </div>
        </div>
    `;
    document.body.appendChild(alertDiv);
    
    setTimeout(() => alertDiv.remove(), 5000);
}

/**
 * Display validation errors on form
 */
function displayValidationErrors(errors) {
    // Clear previous error displays
    document.querySelectorAll('.validation-error').forEach(el => el.remove());
    
    for (let field in errors) {
        const input = document.getElementById(field);
        if (input) {
            const errorDiv = document.createElement('p');
            errorDiv.className = 'text-red-600 text-sm mt-1 validation-error';
            errorDiv.textContent = errors[field][0] || 'Ralat validasi';
            input.parentElement.appendChild(errorDiv);
        }
    }
}

function persistLastApiCall(url, method, status, responseBody) {
    try {
        window.sessionStorage.setItem('lastApiCall', JSON.stringify({
            url,
            method,
            status,
            responseBody,
            at: new Date().toISOString(),
        }));
    } catch (error) {
        console.warn('Gagal simpan rekod API terakhir.', error);
    }
}
