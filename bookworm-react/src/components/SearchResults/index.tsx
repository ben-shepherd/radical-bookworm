import ListResults from 'components/ListResults';
import React from 'react';
import { Book } from 'types/books.t';

type Props = {
    results: Book[];
    PreSearchComponent?: React.ReactNode | null,
    PostSearchComponent: (searchResultsComponent: React.ReactNode) => React.ReactNode;
    onClick?: (book: Book) => any;
}

const SearchResults = ({ results, PreSearchComponent, PostSearchComponent, onClick }: Props): React.ReactNode => {

    if (results.length === 0) {
        return PreSearchComponent
    }

    return PostSearchComponent((
        <ListResults results={results} onClick={onClick} />
    ))
}

export default SearchResults