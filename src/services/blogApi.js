import { getAuthToken, logout } from '@/services/authApi'

async function parseResponse(response) {
  const payload = await response.json().catch(() => ({}))

  if (!response.ok) {
    const message = payload?.error?.description || payload?.message || 'Não foi possível concluir a operação.'

    if (response.status === 401) {
      logout()
    }

    throw new Error(message)
  }

  return payload.data
}

async function request(url, options = {}) {
  const token = getAuthToken()
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

export function listPosts({ published = true, limit, admin = false } = {}) {
  if (admin) {
    return request('/api/admin/posts')
  }

  const query = new URLSearchParams()
  query.set('published', String(published))
  if (limit) {
    query.set('limit', String(limit))
  }

  return request(`/api/posts?${query.toString()}`)
}

export function getPost(slug) {
  return request(`/api/posts/${slug}`)
}

export function createPost(data) {
  return request('/api/admin/posts', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
  })
}

export function updatePost(id, data) {
  return request(`/api/admin/posts/${id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
  })
}

export function deletePost(id) {
  return request(`/api/admin/posts/${id}`, {
    method: 'DELETE',
  })
}
