const TOKEN_KEY = 'hydra_admin_token'

function getToken() {
  return localStorage.getItem(TOKEN_KEY)
}

function setToken(token) {
  localStorage.setItem(TOKEN_KEY, token)
}

function clearToken() {
  localStorage.removeItem(TOKEN_KEY)
}

async function parseResponse(response) {
  const payload = await response.json().catch(() => ({}))

  if (!response.ok) {
    const message = payload?.error?.description || payload?.message || 'Não foi possível concluir a operação.'
    throw new Error(message)
  }

  return payload.data
}

async function request(url, options = {}) {
  const token = getToken()
  const headers = {
    ...(options.headers || {}),
  }

  if (token) {
    headers.Authorization = `Bearer ${token}`
  }

  const response = await fetch(url, {
    ...options,
    headers,
  })

  return parseResponse(response)
}

export async function login(email, password) {
  const data = await request('/api/auth/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ email, password }),
  })

  setToken(data.token)
  return data
}

export function logout() {
  clearToken()
}

export function fetchProfile() {
  return request('/api/admin/auth/me')
}

export function updateAccount(payload) {
  return request('/api/admin/auth/account', {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(payload),
  })
}

export async function uploadImage(file) {
  const token = getToken()
  const formData = new FormData()
  formData.append('image', file)

  const response = await fetch('/api/admin/uploads', {
    method: 'POST',
    headers: token ? { Authorization: `Bearer ${token}` } : {},
    body: formData,
  })

  return parseResponse(response)
}

export function getAuthToken() {
  return getToken()
}
