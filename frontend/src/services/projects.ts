import api from './api'
import type { Project, ProjectFilters } from '@/types'

export async function listProjects(filters: ProjectFilters = {}): Promise<Project[]> {
  const { data } = await api.get<Project[]>('/projects', { params: filters })
  return data
}

export async function getFeaturedProjects(): Promise<Project[]> {
  return listProjects({ featured: true })
}

export async function getProjectBySlug(slug: string): Promise<Project> {
  const { data } = await api.get<Project>(`/projects/${slug}`)
  return data
}
