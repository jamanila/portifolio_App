import axios from 'axios'
import api from './api'
import type { User } from '@/types'

export async function ensureCsrfCookie(): Promise<void> {
  await axios.get(`${import.meta.env.VITE_APP_URL}/sanctum/csrf-cookie`, {
    withCredentials: true,
  })
}

export async function login(email: string, password: string): Promise<User> {
  await ensureCsrfCookie()
  const { data } = await api.post<User>('/login', { email, password })
  return data
}

export async function logout(): Promise<void> {
  await api.post('/logout')
}

export async function me(): Promise<User> {
  const { data } = await api.get<User>('/user')
  return data
}
