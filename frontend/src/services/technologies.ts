import api from './api'
import type { Technology } from '@/types'

export interface TechnologyPayload {
  name: string
  icon?: string
}

export async function listTechnologies(): Promise<Technology[]> {
  const { data } = await api.get<Technology[]>('/technologies')
  return data
}

export async function createTechnology(payload: TechnologyPayload): Promise<Technology> {
  const { data } = await api.post<Technology>('/technologies', payload)
  return data
}

export async function updateTechnology(id: number, payload: TechnologyPayload): Promise<Technology> {
  const { data } = await api.put<Technology>(`/technologies/${id}`, payload)
  return data
}

export async function deleteTechnology(id: number): Promise<void> {
  await api.delete(`/technologies/${id}`)
}
