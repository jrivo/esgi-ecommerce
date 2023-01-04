import { Entity, PrimaryGeneratedColumn, Column } from 'typeorm';

@Entity()
export class Product {
  @PrimaryGeneratedColumn()
  id: number;

  @Column()
  name: string;

  @Column()
  price: number;

  // colors is an array of strings that can be null
  @Column('simple-array', { nullable: true })
  colors: string[];

  @Column('simple-array', { nullable: true })
  sizes: string[];

  @Column({ nullable: true })
  description: string;

  @Column('simple-array', { nullable: true })
  images: string[];
}
