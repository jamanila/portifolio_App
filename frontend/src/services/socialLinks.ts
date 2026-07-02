import api from './api'
import type { SocialLink } from '@/types'

export interface SocialLinkPayload {
  platform: string
  url: string
  icon?: string
  is_active?: boolean
  sort_order?: number
}

export async function listSocialLinks(): Promise<SocialLink[]> {
  const { data } = await api.get<SocialLink[]>('/social-links')
  return data
}

export async function createSocialLink(payload: SocialLinkPayload): Promise<SocialLink> {
  const { data } = await api.post<SocialLink>('/social-links', payload)
  return data
}

export async function updateSocialLink(id: number, payload: SocialLinkPayload): Promise<SocialLink> {
  const { data } = await api.put<SocialLink>(`/social-links/${id}`, payload)
  return data
}

export async function deleteSocialLink(id: number): Promise<void> {
  await api.delete(`/social-links/${id}`)
}
