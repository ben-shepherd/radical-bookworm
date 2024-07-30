import React from 'react';
import { Book } from '../../types/books.t';
import GalleryItem from './GalleryItem';

type Props = {
    data: Book[],
    maxItems?: number
}

const Gallery = ({ data, maxItems = 6 }: Props) => {

    const filteredItems = data.slice(0, maxItems);

    return (
        <div className="Gallery grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
            {filteredItems.map((item: Book) => <GalleryItem key={item.id} item={item} />)}
        </div>
    )
}

export default Gallery