/**
 * API Handler - Intercept form submissions and route to API
 */

const apiDebugMode = new URLSearchParams(window.location.search).has('debugApi')
    || window.localStorage.getItem('debugApi') === '1';

const SUPPORTED_RESOURCES = ['muallafs', 'pendakwahs'];

console.log('✓ API Handler loaded successfully');

document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 DOM ready. Setting up form interceptors...');

    const selector = SUPPORTED_RESOURCES.map((resource) => `form[action*="${resource}"]`).join(', ');
    const resourceForm = document.querySelector(selector);

    if (resourceForm) {
        const action = resourceForm.getAttribute('action') || '';
        const resource = extractResource(action);

        if (resource) {
            console.log('📝 Resource form found:', action);

            resourceForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                console.log('🚀 Form submitted. Intercepting...');

                const formData = new FormData(resourceForm);
                const method = formData.get('_method')?.toUpperCase() || 'POST';
                const isUpdate = method === 'PUT' || method === 'PATCH';
                const recordId = extractRecordId(action);
                const apiEndpoint = isUpdate ? `/api/${resource}/${recordId}` : `/api/${resource}`;

                if (isUpdate) {
                    formData.set('_method', 'PUT');
                }

                console.log(`📡 Routing to API: ${method} ${apiEndpoint}`);
                logFormData(formData);

                try {
                    showLoadingState(true);

                    const response = await fetch(apiEndpoint, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token'),
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    const result = await parseResponse(response);
                    persistLastApiCall(apiEndpoint, isUpdate ? 'PUT' : 'POST', response.status, result);

                    if (response.ok) {
                        showSuccessMessage(result.message || 'Operasi berjaya.');

                        if (apiDebugMode) {
                            console.log('Debug mode aktif: redirect dihentikan untuk semakan Network.');
                        } else {
                            setTimeout(() => {
                                window.location.href = `/${resource}`;
                            }, 1500);
                        }
                    } else {
                        showErrorMessage(result.message || 'Ralat berlaku.');
                        displayValidationErrors(result.errors || {});
                    }
                } catch (error) {
                    console.error('❌ Network error:', error);
                    showErrorMessage('Ralat rangkaian: ' + error.message);
                } finally {
                    showLoadingState(false);
                }
            });
        }
    }

    setupDeleteHandlers();
});

/**
 * Extract resource from form action URL
 */
function extractResource(action) {
    const match = action.match(/\/(muallafs|pendakwahs)(?:\/|$)/);
    return match ? match[1] : null;
}

/**
 * Extract record ID from form action URL
 */
function extractRecordId(action) {
    const match = action.match(/\/(\d+)(?:\/edit)?(?:\?.*)?$/);
    return match ? match[1] : null;
}

/**
 * Setup delete button handlers
 */
function setupDeleteHandlers() {
    const selector = SUPPORTED_RESOURCES
        .map((resource) => `form[action*="${resource}"][method="POST"]`)
        .join(', ');

    document.querySelectorAll(selector).forEach(form => {
        const methodInput = form.querySelector('input[name="_method"]');
        const action = form.getAttribute('action') || '';
        const resource = extractResource(action);
        
        if (methodInput && methodInput.value === 'DELETE' && resource) {
            console.log('🗑️ Delete form found:', action);
            
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                if (!confirm('Adakah anda pasti untuk padam rekod ini?')) {
                    console.log('Cancel delete action');
                    return;
                }
                
                const recordId = extractRecordId(action);
                const formData = new FormData(form);
                
                console.log(`🚀 Delete submitted for ${resource} ID: ${recordId}`);
                
                try {
                    showLoadingState(true);
                    
                    const endpoint = `/api/${resource}/${recordId}`;
                    const response = await fetch(endpoint, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token'),
                            'Accept': 'application/json',
                        },
                    });
                    
                    const result = await parseResponse(response);
                    persistLastApiCall(endpoint, 'DELETE', response.status, result);
                    
                    if (response.ok) {
                        showSuccessMessage(result.message || 'Rekod berjaya dipadam.');
                        if (apiDebugMode) {
                            console.log('Debug mode aktif: redirect dihentikan untuk semakan Network.');
                        } else {
                            setTimeout(() => {
                                window.location.href = `/${resource}`;
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
        if (!btn.dataset.originalText) {
            btn.dataset.originalText = btn.textContent;
        }

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

async function parseResponse(response) {
    try {
        return await response.json();
    } catch (error) {
        return {
            success: false,
            message: 'Respons API tidak sah (bukan JSON).',
        };
    }
}

function logFormData(formData) {
    const entries = [];
    for (const [key, value] of formData.entries()) {
        if (value instanceof File) {
            entries.push({ key, file: value.name, size: value.size, type: value.type });
        } else {
            entries.push({ key, value });
        }
    }
    console.log('📦 FormData entries:', entries);
}
