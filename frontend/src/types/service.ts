export interface Service {
  id: number
  title: string
  slug: string
  icon: string | null
  description: string
  benefits: string[] | null
  sort_order: number
}
