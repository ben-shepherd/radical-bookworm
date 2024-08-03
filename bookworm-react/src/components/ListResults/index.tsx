import { Book } from 'types/books.t';
import useFavouriteBooks from "../../hooks/Books/useFavouriteBooks";
import ListItem, { ListItemEventProps } from './ListItem';

type Props = {
    results: Book[]
    onClick?: (book: Book) => any;
    onRefresh?: (...args: any[]) => any;
}

const ListResults = ({ results, ...listItemProps }: Props & ListItemEventProps) => {

    const { books: favouriteBooks } = useFavouriteBooks()

    return (
        <div className="ListResults">
            {results.map((book: Book) => (
                <ListItem className='mb-5' key={book._id} book={book}
                    favouriteBooks={favouriteBooks}
                    {...listItemProps} />
            ))}
        </div>
    )
}

export default ListResults;