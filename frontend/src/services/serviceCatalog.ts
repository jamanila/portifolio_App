import api from './api'
import type { Service } from '@/types'

export interface ServicePayload {
  title: string
  icon?: string
  description: string
  benefits?: string[]
  sort_order?: number
}

export async function listServices(): Promise<Service[]> {
  const { data } = await api.get<Service[]>('/services')
  return data
}

export async function createService(payload: ServicePayload): Promise<Service> {
  const { data } = await api.post<Service>('/services', payload)
  return data
}

export async function updateService(id: number, payload: ServicePayload): Promise<Service> {
  const { data } = await api.put<Service>(`/services/${id}`, payload)
  return data
}

export async function deleteService(id: number): Promise<void> {
  await api.delete(`/services/${id}`)
}
