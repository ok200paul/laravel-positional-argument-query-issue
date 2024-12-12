<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\UserPost;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;


class QueriesUsingPositionalArgumentsNullWithoutOperatorTest extends TestCase
{
    /**
     * Test with operator - PASSES - when using positional args, we need to pass in the operator
     */
    #[Test]
    public function itReturnsDataWhenOperatorExists(): void
    {
        $user = User::first();

        $userPosts = UserPost::where(
            column: 'user_id',
            operator: '=',
            value: $user->id,
        )->get();

        Log::info(UserPost::where(
            column: 'user_id',
            operator: '=',
            value: $user->id,
        )->toSql());


        $count = UserPost::count();

        $this->assertCount(
            expectedCount: $count,
            haystack: $userPosts
        );

    }


    /**
     * Test without operator - FAILS - when using positional args, we need to pass in the operator
     */
    #[Test]
    public function itReturnsDataWhenOperatorDoesNotExist(): void
    {
        $user = User::first();

        $userPosts = UserPost::where(
            column: 'user_id',
            value: $user->id,
        )->get();


        $count = UserPost::count();

        Log::info(UserPost::where(
            column: 'user_id',
            value: $user->id,
        )->toSql());

        $this->assertCount(
            expectedCount: $count,
            haystack: $userPosts
        );



    }

    /**
     * Test without operator where value int - FAILS - when using positional args, we need to pass in the operator
     */
    #[Test]
    public function itReturnsDataWhenOperatorDoesNotExistInteger(): void
    {
        $user = User::first();

        $userPosts = UserPost::where(
            column: 'id',
            value: 1,
        )->get();


        $count = UserPost::count();

        Log::info(UserPost::where(
            column: 'id',
            value: 1,
        )->toSql());

        $this->assertCount(
            expectedCount: $count,
            haystack: $userPosts
        );



    }

    #[Test]
    public function testFungGetArgsReturnsOperator(): void
    {
        $args = $this->funcWhere(
            column: 'a', value: 'c'
        );

        AssertEquals(null, $args[1]);

    }

    #[Test]
    public function testFungGetArgsReturnsOperatorWhenSpecified(): void
    {
        $args = $this->funcWhere(
            column: 'a',
            operator: '=',
            value: 'c'
        );

        AssertEquals('=', $args[1]);

    }

    public function funcWhere($column, $operator = null, $value = null, $boolean = 'and'){

        return func_get_args();
    }

}
