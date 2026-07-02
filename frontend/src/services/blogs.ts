import api from './api'
import type { Blog } from '@/types'

export async function listBlogs(): Promise<Blog[]> {
  const { data } = await api.get<Blog[]>('/blogs')
  return data
}

export async function getBlogBySlug(slug: string): Promise<Blog> {
  const { data } = await api.get<Blog>(`/blogs/${slug}`)
  return data
}
