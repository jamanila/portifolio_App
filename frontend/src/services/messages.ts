import api from './api'
import type { ContactMessage } from '@/types'

export async function listMessages(unreadOnly = false): Promise<ContactMessage[]> {
  const { data } = await api.get<ContactMessage[]>('/contact-messages', {
    params: unreadOnly ? { unread: true } : {},
  })
  return data
}

export async function markMessageAsRead(id: number): Promise<ContactMessage> {
  const { data } = await api.put<ContactMessage>(`/contact-messages/${id}`)
  return data
}

export async function deleteMessage(id: number): Promise<void> {
  await api.delete(`/contact-messages/${id}`)
}
