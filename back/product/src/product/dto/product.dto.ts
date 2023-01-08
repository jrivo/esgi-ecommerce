import { PartialType } from '@nestjs/swagger';

export class CreateProductDto {
  name: string;
  price: number;
  colors?: string[];
  sizes?: string[];
  description?: string;
  images?: string[];
}

export class UpdateProductDto extends PartialType(CreateProductDto) {}
