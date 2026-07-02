export interface Testimonial {
  id: number
  client_name: string
  client_photo: string | null
  company: string | null
  review: string
  rating: number
  is_featured: boolean
}
