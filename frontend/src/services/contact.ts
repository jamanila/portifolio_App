import api from './api'
import type { ContactMessage, ContactMessagePayload } from '@/types'
import { ensureCsrfCookie } from './auth'

export async function submitContactMessage(payload: ContactMessagePayload): Promise<ContactMessage> {
  await ensureCsrfCookie()
  const { data } = await api.post<ContactMessage>('/contact', payload)
  return data
}
