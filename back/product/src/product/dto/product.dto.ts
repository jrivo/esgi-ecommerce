import { PartialType } from '@nestjs/swagger';

export class CreateProductDto {
  name: string;
}

export class UpdateProductDto extends PartialType(CreateProductDto) {}
