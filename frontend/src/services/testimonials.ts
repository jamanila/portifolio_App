import api from './api'
import type { Testimonial } from '@/types'
import { buildFormData } from '@/utils/formData'

export interface TestimonialPayload {
  client_name: string
  client_photo?: File | null
  company?: string
  review: string
  rating: number
  is_featured?: boolean
  sort_order?: number
}

export async function listTestimonials(featured = false): Promise<Testimonial[]> {
  const { data } = await api.get<Testimonial[]>('/testimonials', {
    params: featured ? { featured: true } : {},
  })
  return data
}

export async function createTestimonial(payload: TestimonialPayload): Promise<Testimonial> {
  const { data } = await api.post<Testimonial>('/testimonials', buildFormData(payload))
  return data
}

export async function updateTestimonial(id: number, payload: TestimonialPayload): Promise<Testimonial> {
  const { data } = await api.post<Testimonial>(`/testimonials/${id}`, buildFormData(payload, 'PUT'))
  return data
}

export async function deleteTestimonial(id: number): Promise<void> {
  await api.delete(`/testimonials/${id}`)
}
