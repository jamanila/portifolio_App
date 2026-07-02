import api from './api'
import type { Setting } from '@/types'
import { buildFormData } from '@/utils/formData'

export interface SettingPayload {
  site_name: string
  site_title?: string
  site_description?: string
  logo?: File | null
  favicon?: File | null
  email?: string
  phone?: string
  address?: string
  resume_url?: string
  meta_title?: string
  meta_description?: string
  meta_keywords?: string
}

export async function getSettings(): Promise<Setting> {
  const { data } = await api.get<Setting>('/settings')
  return data
}

export async function updateSettings(payload: SettingPayload): Promise<Setting> {
  const { data } = await api.post<Setting>('/settings', buildFormData(payload, 'PUT'))
  return data
}
