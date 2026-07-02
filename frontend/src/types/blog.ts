import type { Category } from './category'

export interface Blog {
  id: number
  title: string
  slug: string
  excerpt: string | null
  content?: string
  thumbnail: string | null
  is_published: boolean
  published_at: string | null
  category: Category | null
}
